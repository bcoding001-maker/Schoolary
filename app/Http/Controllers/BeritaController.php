<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('user')->latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'status' => 'required|in:draft,published',
            'is_featured' => 'nullable'
        ]);

        try {
            $validated['user_id'] = auth()->user()->id;
            
            // Generate unique slug
            $baseSlug = Str::slug($request->judul);
            $slug = $baseSlug;
            $counter = 1;

            // Check if slug exists and generate a unique one
            while (Berita::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $validated['slug'] = $slug;
            $validated['is_featured'] = $request->has('is_featured') ? true : false;

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/berita'), $filename);
                $validated['thumbnail'] = $filename;
            }

            Berita::create($validated);

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            // If there's an error with the file upload, delete it
            if (isset($filename) && file_exists(public_path('storage/berita/' . $filename))) {
                unlink(public_path('storage/berita/' . $filename));
            }

            return redirect()->route('admin.berita.index')
                ->with('error', 'Gagal menambahkan berita. Silakan coba lagi.');
        }
    }

    public function edit($berita_id)
    {
        try {
            $berita = Berita::findOrFail($berita_id);
            return view('admin.berita.edit', compact('berita'));
        } catch (\Exception $e) {
            return redirect()->route('admin.berita.index')
                ->with('error', 'Berita tidak ditemukan');
        }
    }

    public function update(Request $request, $berita_id)
    {
        try {
            $berita = Berita::findOrFail($berita_id);
            
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'konten' => 'required|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
                'status' => 'required|in:draft,published',
                'is_featured' => 'boolean'
            ]);

            // Handle slug update if title changes
            if ($request->judul !== $berita->judul) {
                $baseSlug = Str::slug($request->judul);
                $slug = $baseSlug;
                $counter = 1;

                while (Berita::withTrashed()
                    ->where('slug', $slug)
                    ->where('berita_id', '!=', $berita_id)
                    ->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                
                $validated['slug'] = $slug;
            }

            // Handle thumbnail update
            if ($request->hasFile('thumbnail')) {
                if ($berita->thumbnail) {
                    Storage::disk('public')->delete('berita/' . $berita->thumbnail);
                }

                $file = $request->file('thumbnail');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/berita'), $filename);
                $validated['thumbnail'] = $filename;
            } elseif ($request->remove_thumbnail == '1') {
                if ($berita->thumbnail) {
                    Storage::disk('public')->delete('berita/' . $berita->thumbnail);
                }
                $validated['thumbnail'] = null;
            }

            $validated['is_featured'] = $request->has('is_featured');

            $berita->update($validated);

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->route('admin.berita.index')
                ->with('error', 'Gagal memperbarui berita. Silakan coba lagi.');
        }
    }

    public function destroy($berita_id)
    {
        try {
            $berita = Berita::findOrFail($berita_id);

            // Delete thumbnail if exists
            if ($berita->thumbnail && Storage::disk('public')->exists('berita/' . $berita->thumbnail)) {
                Storage::disk('public')->delete('berita/' . $berita->thumbnail);
            }

            // Delete the news record
            $berita->delete();

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil dihapus!');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.berita.index')
                ->with('error', 'Berita tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->route('admin.berita.index')
                ->with('error', 'Gagal menghapus berita. Silakan coba lagi.');
        }
    }
}