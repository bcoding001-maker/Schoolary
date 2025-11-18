<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\PhotoLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoLikeController extends Controller
{
    public function toggle(Request $request, $photoId)
    {
        try {
            $photo = Photo::findOrFail($photoId);
            $ipAddress = $request->ip();
            $userAgent = $request->userAgent();
            $userId = Auth::id();

            // Check if already liked (prefer user_id when available, otherwise IP)
            $query = PhotoLike::where('photo_id', $photoId);

            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('ip_address', $ipAddress);
            }

            $existingLike = $query->first();

            if ($existingLike) {
                // Unlike - remove the like
                $existingLike->delete();
                $liked = false;
                $message = 'Like dihapus';
            } else {
                // Like - add new like
                PhotoLike::create([
                    'photo_id' => $photoId,
                    'user_id' => $userId,
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent
                ]);
                $liked = true;
                $message = 'Foto disukai';
            }

            // Get updated likes count
            $likesCount = $photo->likes()->count();

            return response()->json([
                'success' => true,
                'liked' => $liked,
                'likes_count' => $likesCount,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getLikes($photoId)
    {
        try {
            $photo = Photo::findOrFail($photoId);
            $ipAddress = request()->ip();
            
            return response()->json([
                'success' => true,
                'likes_count' => $photo->likes()->count(),
                'is_liked' => $photo->isLikedByIp($ipAddress)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Foto tidak ditemukan'
            ], 404);
        }
    }

    public function incrementView($photoId)
    {
        try {
            $photo = Photo::findOrFail($photoId);
            $photo->increment('views_count');
            
            return response()->json([
                'success' => true,
                'views_count' => $photo->views_count
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Foto tidak ditemukan'
            ], 404);
        }
    }
}
