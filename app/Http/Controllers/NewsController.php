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
            ->whereNotNull('published_at') // Assuming we only show published posts
            ->latest('published_at');

        // Search Filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
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
        $categories = Category::withCount('posts')->get(); // Get categories with post count
        $tags = Tag::all();

        return view('news', compact('posts', 'categories', 'tags'));
    }
}
