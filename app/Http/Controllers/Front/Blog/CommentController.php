<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'body' => ['required', 'max:1000'],
        ]);


        $comment = new Comment();
        $comment->ip = $request->ip();
        $comment->commentable_type = Post::class;
        $comment->commentable_id = $post->id;
        $comment->user_id = Auth::check() ? Auth::id() : null;
        $comment->name = $request->get('name');
        $comment->email = $request->get('email');
        $comment->body = $request->get('body');
        $comment->save();

        return back()->with('success', trans('comments.created'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
