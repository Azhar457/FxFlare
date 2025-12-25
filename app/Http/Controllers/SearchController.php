<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        if (!$query) {
            return response()->json([]);
        }

        $posts = Post::with('category')
            ->where('status', 'published')
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest()
            ->take(5) // Limit results for preview
            ->get()
            ->map(function ($post) {
                return [
                    'title' => $post->title,
                    'category' => $post->category->name,
                    'url' => route('news.show', $post)
                ];
            });

        return response()->json($posts);
    }
}
