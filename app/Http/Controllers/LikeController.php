<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        $like = Like::where('user_id', Auth::id())
                    ->where('post_id', $post->id)
                    ->first();

        if ($like) {
            $like->delete();
            $liked = false;
            $message = 'Like dihapus.';
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id
            ]);
            $liked = true;
            $message = 'Post disukai!';
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'liked' => $liked,
                'count' => $post->likes()->count(),
                'message' => $message
            ]);
        }

        return back()->with('success', $message);
    }
}
