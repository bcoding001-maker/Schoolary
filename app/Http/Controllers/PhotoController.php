<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function create($album_id)
    {
        $album = Album::findOrFail($album_id);
        return view('admin.photo.create', compact('album'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,album_id',
            'title_prefix' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $uploadedPhotos = 0;

        foreach($request->file('images') as $index => $image) {
            $filename = time() . '_' . $index . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/photos'), $filename);
            
            Photo::create([
                'album_id' => $request->album_id,
                'title' => $request->title_prefix . ' - Photo ' . ($index + 1),
                'description' => $request->description,
                'image_path' => 'photos/' . $filename
            ]);

            $uploadedPhotos++;
        }

        return redirect()->route('admin.album.show', $request->album_id)
                        ->with('success', $uploadedPhotos . ' photos successfully uploaded');
    }

    public function destroy(Photo $photo)
    {
        $album_id = $photo->album_id;
        
        if ($photo->image_path) {
            Storage::disk('public')->delete($photo->image_path);
        }
        
        $photo->delete();
        
        return redirect()->route('admin.album.show', $album_id)
                        ->with('success', 'Foto berhasil dihapus');
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'selected_photos' => 'required|array',
            'selected_photos.*' => 'exists:photos,id'
        ]);

        try {
            $photos = Photo::whereIn('id', $request->selected_photos)->get();
            
            if ($photos->isEmpty()) {
                return back()->with('error', 'No photos found to delete');
            }

            $album_id = $photos->first()->album_id;

            foreach($photos as $photo) {
                if ($photo->image_path) {
                    Storage::disk('public')->delete($photo->image_path);
                }
                $photo->delete();
            }

            return redirect()->route('admin.album.show', $album_id)
                            ->with('success', count($request->selected_photos) . ' photos have been deleted');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete photos: ' . $e->getMessage());
        }
    }

    /**
     * Display a report of photos with engagement statistics for admin.
     */
    public function report()
    {
        $photos = Photo::with('album')
            ->withCount(['likes as likes_count', 'comments as comments_count'])
            ->orderByDesc('views_count')
            ->paginate(20);

        return view('admin.photo.report', compact('photos'));
    }
} 