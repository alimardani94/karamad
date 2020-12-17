<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('pages.admin.tag.create', [
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:tags'],
        ]);


        $category = new Tag();
        $category->name = $request->get('name');
        $category->save();

        return redirect()->route('admin.tags.create')->with('success', trans('tags.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Tag $tag
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Tag $tag)
    {
        $tag->posts()->detach();
        $tag->delete();

        return new JsonResponse(['message' => trans('categories.deleted')]);
    }
}
