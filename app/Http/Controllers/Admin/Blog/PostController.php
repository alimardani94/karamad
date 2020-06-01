<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view('admin.post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.post.create', [
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'unique:posts'],
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'content' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png,gif,svg|max:4096',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string|min:135|max:160',
        ]);

        $path = $request->file('image')->store('posts');

        $post = new Post();
        $post->title = $request->get('title');
        $post->content = preventXSS($request->get('content'));
        $post->image = $path;
        $post->author_id = Auth::id();
        $post->meta_keywords = $request->get('meta_keywords');
        $post->meta_description = $request->get('meta_description');
        $post->save();

        $post->tags()->attach($request->get('tags'));

        return redirect()->route('admin.posts.index')->with('success', trans('posts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
