<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
 use App\Models\Tag;
use Auth;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
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
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.post.create', [
            'tags' => Tag::all(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
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
     * @param Post $post
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        return view('admin.post.edit', [
            'post' => $post,
            'tags' => Tag::all(),
        ]);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'unique:posts,title,' . $post->id],
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'content' => 'required',
            'image' => 'nullable|mimes:jpeg,bmp,png,gif,svg|max:4096',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string|min:135|max:160',
        ]);

        $path = $post->image;
        if ($request->file('image')) {
            $path = $request->file('image')->store('posts');
        }

        $post->title = $request->get('title');
        $post->content = preventXSS($request->get('content'));
        $post->image = $path;
        $post->author_id = Auth::id();
        $post->meta_keywords = $request->get('meta_keywords');
        $post->meta_description = $request->get('meta_description');
        $post->save();

        $post->tags()->sync($request->get('tags'));

        return redirect()->route('admin.posts.index')->with('success', trans('posts.updated'));
    }

    /**
     * @param Post $post
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();

        return new JsonResponse(['message' => trans('categories.deleted')]);
    }
}
