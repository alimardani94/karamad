<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
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
     * @param $postId
     * @return Application|Factory|View
     */
    public function show(int $postId)
    {
        $post = Post::whereId($postId)->with('comments')->withCount('comments')->first();

        $relatedPosts = Post::where('id', '<>', $postId)->limit(6)->get();

        return view('blog.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

}
