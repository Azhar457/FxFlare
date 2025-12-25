<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => Post::count(),
            'users' => User::count(),
            'categories' => Category::count(),
            'tags' => Tag::count(),
            'comments' => \App\Models\Comment::count(),
            'likes' => \App\Models\Like::count(),
        ];

        
        $latestPosts = Post::with('user', 'category')->latest()->take(5)->get();
        $latestUsers = User::latest()->take(5)->get();

        return view('dashboard.index', compact('stats', 'latestPosts', 'latestUsers'));
    }
}
