<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        return redirect()->route('posts.show', $post->id);
    }
}
