<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Course;
use App\Rules\CheckCategoryParent;
use App\Rules\UniqueCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.category.create', [
            'mainCategories' => Category::whereParentId(0)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', new UniqueCategory($request->get('parent'))],
            'parent' => ['nullable', 'exists:categories,id', new CheckCategoryParent()],
            'image' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'description' => 'required|max:1024',
        ]);

        $path = $request->file('image')->store('categories');

        $category = new Category();
        $category->name = $request->get('name');
        $category->parent_id = $request->get('parent') ?? 0;
        $category->image = $path;
        $category->description = $request->get('description');
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', trans('categories.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *  @return Factory|View
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', [
            'mainCategories' => Category::whereParentId(0)->where('id', '<>', $id)->get(),
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', new UniqueCategory($request->get('parent'), $id)],
            'parent' => ['nullable', 'exists:categories,id', new CheckCategoryParent()],
            'image' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'description' => 'required|max:1024',
        ]);

        $category = Category::findOrFail($id);

        $path = $category->image;
        if ($request->file('image')) {
            $path = $request->file('image')->store('categories');
        }

        $category->name = $request->get('name');
        $category->parent_id = $request->get('parent') ?? 0;
        $category->image = $path;
        $category->description = $request->get('description');
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', trans('categories.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        // update children of deleted category
        Category::where('parent_id', $id)->update(['parent_id' => 0]);
        Course::where('category_id', $id)->update(['category_id' => 0]);

        return new JsonResponse(['message' => trans('categories.deleted')]);
    }
}
