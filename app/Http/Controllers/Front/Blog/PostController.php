<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        $tags = Tag::withCount(['posts'])->orderBy('posts_count', 'DESC')->get();
        $relatedPosts = Post::inRandomOrder()->limit(5)->get();
        $popularPosts = Post::inRandomOrder()->limit(3)->get();
        $newestPosts = Post::inRandomOrder()->limit(3)->get();

        return view('blog.index', [
            'posts' => $posts,
            'tags' => $tags,
            'popularPosts' => $popularPosts,
            'newestPosts' => $newestPosts,
            'relatedPosts' => $relatedPosts,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('blog.show', [
            'post' => $post,
        ]);
    }

}
