<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Services\FlashNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
            'parent_id' => $request->parent_id
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Comment added successfully',
                'html' => view('news.partials.comment-item', ['comment' => $comment])->render(),
                'count' => $post->comments()->count()
            ]);
        }

        FlashNotification::success('Komentar berhasil ditambahkan!', 'Sukses');

        return back();
    }

    public function destroy(Comment $comment)
    {
        // Authorize: Admin or Owner
        if (Auth::id() !== $comment->user_id && Auth::user()->role->name !== 'admin') {
            abort(403);
        }

        $comment->delete();

        FlashNotification::success('Komentar berhasil dihapus.', 'Dihapus');

        return back();
    }
}
