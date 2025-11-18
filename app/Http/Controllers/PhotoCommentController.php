<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\PhotoComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoCommentController extends Controller
{
    public function index(Photo $photo)
    {
        $comments = $photo->comments()
            ->with('user')
            ->latest()
            ->take(50)
            ->get()
            ->map(function (PhotoComment $comment) {
                return [
                    'id' => $comment->id,
                    'user_name' => optional($comment->user)->name,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => $comments,
        ]);
    }

    public function store(Request $request, Photo $photo)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated',
            ], 401);
        }

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:500'],
        ]);

        $comment = PhotoComment::create([
            'photo_id' => $photo->id,
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        $comment->load('user');

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $comment->id,
                'user_name' => optional($comment->user)->name,
                'content' => $comment->content,
                'created_at' => $comment->created_at->diffForHumans(),
            ],
        ]);
    }
}
