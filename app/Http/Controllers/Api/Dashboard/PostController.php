<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'user', 'tags'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }

        return PostResource::collection(
            $query->paginate(10)
        );
    }

    public function show(Post $post)
    {
        $post->load(['category', 'user', 'tags']);

        return new PostResource($post);
    }
}
