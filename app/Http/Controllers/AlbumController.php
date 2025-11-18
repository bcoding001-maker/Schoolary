<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        $categories = Kategori::with(['albums' => function($query) {
            $query->whereNull('parent_id')->latest();
        }])->orderBy('kategori_judul')->get();
        
        return view('admin.album.index', compact('categories'));
    }

    public function create()
    {
        $categories = Kategori::all();
        $parentAlbums = Album::whereNull('parent_id')->get();
        return view('admin.album.create', compact('categories', 'parentAlbums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'album_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'parent_id' => 'nullable|exists:albums,album_id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        // Cek kedalaman sub album
        if ($request->parent_id) {
            $depth = $this->getAlbumDepth($request->parent_id);
            if ($depth >= 3) {
                return back()->with('error', 'Tidak dapat membuat sub album lebih dari 3 level');
            }
        }

        $data = $request->all();
        $data['created_by'] = Auth::user()->id;

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/album-covers'), $filename);
            $data['cover_image'] = 'album-covers/' . $filename;
        }

        $album = Album::create($data);

        if ($request->parent_id) {
            return redirect()->route('admin.album.show', $request->parent_id)
                            ->with('success', 'Sub album berhasil dibuat');
        }

        return redirect()->route('admin.album.index')
                        ->with('success', 'Album berhasil dibuat');
    }

    // Fungsi untuk mengecek kedalaman album
    private function getAlbumDepth($albumId)
    {
        $depth = 0;
        $album = Album::find($albumId);
        
        while ($album && $album->parent_id) {
            $depth++;
            $album = Album::find($album->parent_id);
        }
        
        return $depth;
    }

    public function show(Album $album)
    {
        $album->load(['photos', 'children', 'parent', 'kategori']);
        
        // Hitung kedalaman album saat ini
        $albumDepth = $this->getAlbumDepth($album->album_id);
        
        // Tentukan apakah masih bisa membuat sub album
        $canCreateSubAlbum = $albumDepth < 3;
        
        return view('admin.album.show', compact('album', 'albumDepth', 'canCreateSubAlbum'));
    }

    public function destroy(Album $album)
    {
        try {
            \Log::info('Attempting to delete album: ' . $album->album_id);
            
            // Simpan parent_id sebelum album dihapus
            $parentId = $album->parent_id;
            
            // Hapus semua sub-albums secara rekursif
            $this->deleteAlbumRecursively($album);
            
            \Log::info('Album deleted successfully: ' . $album->album_id);

            // Jika ini adalah sub-album (memiliki parent)
            if ($parentId) {
                return redirect()->route('admin.album.show', $parentId)
                    ->with('success', 'Album berhasil dihapus');
            }

            // Jika ini adalah album utama
            return redirect()->route('admin.album.index')
                ->with('success', 'Album berhasil dihapus');
            
        } catch (\Exception $e) {
            \Log::error('Error deleting album: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Jika ini adalah sub-album
            if (isset($album) && $album->parent_id) {
                return redirect()->route('admin.album.show', $album->parent_id)
                    ->with('error', 'Terjadi kesalahan saat menghapus album: ' . $e->getMessage());
            }

            // Jika ini adalah album utama
            return redirect()->route('admin.album.index')
                ->with('error', 'Terjadi kesalahan saat menghapus album: ' . $e->getMessage());
        }
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'selected_albums' => 'required|array',
            'selected_albums.*' => 'exists:albums,album_id'
        ]);

        try {
            $albums = Album::whereIn('album_id', $request->selected_albums)->get();
            
            foreach($albums as $album) {
                // Delete cover image
                if ($album->cover_image) {
                    Storage::disk('public')->delete($album->cover_image);
                }
                
                // Delete all photos in the album
                foreach($album->photos as $photo) {
                    if ($photo->image_path) {
                        Storage::disk('public')->delete($photo->image_path);
                    }
                    $photo->delete();
                }
                
                // Delete all sub-albums recursively
                foreach($album->children as $subAlbum) {
                    $this->deleteAlbumRecursively($subAlbum);
                }
                
                // Delete the album
                $album->delete();
            }

            return back()->with('success', count($request->selected_albums) . ' albums have been deleted');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete albums: ' . $e->getMessage());
        }
    }

    public function edit(Album $album)
    {
        $categories = Kategori::all();
        $parentAlbums = Album::whereNull('parent_id')
            ->where('album_id', '!=', $album->album_id)
            ->get();
        
        return view('admin.album.edit', compact('album', 'categories', 'parentAlbums'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'album_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'parent_id' => [
                'nullable',
                'exists:albums,album_id',
                function ($attribute, $value, $fail) use ($album) {
                    if ($value == $album->album_id) {
                        $fail('Album cannot be its own parent.');
                    }
                },
            ],
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        // Cek kedalaman sub album jika ada parent_id
        if ($request->parent_id && $request->parent_id != $album->parent_id) {
            $depth = $this->getAlbumDepth($request->parent_id);
            if ($depth >= 3) {
                return back()->with('error', 'Tidak dapat memindahkan album ke level yang lebih dalam dari 3 level');
            }
        }

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            // Hapus cover image lama jika ada
            if ($album->cover_image && Storage::exists($album->cover_image)) {
                Storage::delete($album->cover_image);
            }

            // Upload cover image baru
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/album-covers'), $filename);
            $data['cover_image'] = 'album-covers/' . $filename;
        }

        $album->update($data);

        // Mengambil URL sebelumnya dari session
        $previousUrl = url()->previous();
        
        // Cek apakah URL sebelumnya adalah halaman edit
        if (str_contains($previousUrl, '/edit')) {
            // Jika dari halaman edit, redirect ke index
            return redirect()->route('admin.album.index')
                            ->with('success', 'Album berhasil diperbarui');
        }
        
        // Jika dari halaman lain, kembali ke halaman tersebut
        return redirect($previousUrl)
                        ->with('success', 'Album berhasil diperbarui');
    }

    public function getAlbumContent($id)
    {
        try {
            $album = Album::with([
                'photos.likes',
                'kategori',
                'children' => function($query) {
                    $query->withCount('photos');
                },
                'children.photos',
                'parent'
            ])->findOrFail($id);

            $ipAddress = request()->ip();
            $userId = auth()->id();

            // Add likes count, views count and is_liked status to each photo
            $photosWithLikes = $album->photos->map(function($photo) use ($ipAddress, $userId) {
                return [
                    'id' => $photo->id,
                    'album_id' => $photo->album_id,
                    'title' => $photo->title,
                    'description' => $photo->description,
                    'image_path' => $photo->image_path,
                    'likes_count' => $photo->likes()->count(),
                    'views_count' => $photo->views_count,
                    'is_liked' => $userId
                        ? $photo->likes()->where('user_id', $userId)->exists()
                        : $photo->isLikedByIp($ipAddress),
                    'created_at' => $photo->created_at,
                    'updated_at' => $photo->updated_at
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => [
                    'album_id' => $album->album_id,
                    'album_name' => $album->album_name,
                    'description' => $album->description,
                    'cover_image' => $album->cover_image,
                    'kategori' => $album->kategori,
                    'photos' => $photosWithLikes,
                    'sub_albums' => $album->children,
                    'parent' => $album->parent
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch album data'
            ], 500);
        }
    }

    // Tambahkan method edit, update, dan destroy sesuai kebutuhan

    private function deleteAlbumRecursively($album)
    {
        // Delete all sub-albums recursively
        foreach($album->children as $subAlbum) {
            $this->deleteAlbumRecursively($subAlbum);
        }
        
        // Delete cover image
        if ($album->cover_image) {
            Storage::disk('public')->delete($album->cover_image);
        }
        
        // Delete all photos in the album
        foreach($album->photos as $photo) {
            if ($photo->image_path) {
                Storage::disk('public')->delete($photo->image_path);
            }
            $photo->delete();
        }
        
        // Delete the album
        $album->delete();
    }
} 