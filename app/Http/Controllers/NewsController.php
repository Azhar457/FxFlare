<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'tags', 'user'])
            ->where('status', 'published') // Explicit status check
            ->whereNotNull('published_at') 
            ->latest('published_at');

        // Search Filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%"); // changed from body to content
            });
        }

        // Category Filter
        if ($request->has('category') && $request->category != '') {
            $categorySlug = $request->category;
            $query->whereHas('category', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Tag Filter
        if ($request->has('tag') && $request->tag != '') {
            $tagSlug = $request->tag;
            $query->whereHas('tags', function($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }

        $posts = $query->paginate(9)->withQueryString();
        
        if ($request->ajax()) {
            return view('news.partials.list', compact('posts'))->render();
        }

        $categories = Category::withCount('posts')->get(); // Get categories with post count
        $tags = Tag::all();

        return view('news', compact('posts', 'categories', 'tags'));
    }

    public function show(Post $post)
    {
        // Increase view count or other logic if needed
        return view('news.show', compact('post'));
    }
}
