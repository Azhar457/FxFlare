<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ensure admin
        if (Auth::user()->role->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $query = Post::with(['category', 'user'])->latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(10);

        if ($request->ajax()) {
            return view('posts.partials.list', compact('posts'))->render();
        }
        
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role->name !== 'admin') {
            abort(403);
        }
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role->name !== 'admin') {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:200',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->only(['title', 'content', 'category_id', 'status']);
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        $data['user_id'] = Auth::id();
        
        // Fix: Auto-set published_at if status is published
        if ($request->status == 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public'); // Requires storage link
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (Auth::user()->role->name !== 'admin') {
            abort(403);
        }
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::user()->role->name !== 'admin') {
            abort(403);
        }
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->role->name !== 'admin') {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:200',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->only(['title', 'content', 'category_id', 'status']);
        
        // Update slug only if title changes significantly (optional, but good for SEO vs links breaking)
        if ($request->title !== $post->title) {
            $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        }

        // Fix: Set published_at if becoming published and not set previously
        if ($request->status == 'published' && is_null($post->published_at)) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->role->name !== 'admin') {
            abort(403);
        }

        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }
}