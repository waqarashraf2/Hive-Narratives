<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $blog = Blog::findOrFail($id);

        $comment = new Comment();
        $comment->blog_id = $blog->id;
        $comment->user_id = Auth::id(); // Get logged-in user
        $comment->content = $request->content;
        $comment->save();

        return response()->json([
            'comment' => [
                'user' => Auth::user()->name,
                'content' => $comment->content,
                'created_at' => $comment->created_at->diffForHumans(),
            ],
        ]);
    }
}
