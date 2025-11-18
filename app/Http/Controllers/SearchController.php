<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Album;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');

        $posts = Post::where('post_judul', 'like', "%{$query}%")
            ->orWhere('post_isi', 'like', "%{$query}%")
            ->get();

        $albums = Album::where('album_name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        return view('admin.search.results', compact('posts', 'albums', 'query'));
    }
} 