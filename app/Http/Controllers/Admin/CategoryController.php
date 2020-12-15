<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Rules\UniqueCategory;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if (!$request->get('type')) {
            abort(404);
        }

        $categories = Category::where('type', $request->get('type'))->paginate(10);

        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function create(Request $request)
    {
        if (!$request->get('type')) {
            throw new RouteNotFoundException();
        }

        $categories = Category::whereParentId(0)->where('type', $request->get('type'))->get();

        return view('admin.category.create', [
            'mainCategories' => $categories,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', new UniqueCategory($request->get('parent'))],
            'parent' => ['nullable', 'exists:categories,id'],
            'image' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'description' => 'nullable|max:1024',
        ]);

        $path = $request->file('image')->store('categories');

        $category = new Category();
        $category->type = $request->get('type');
        $category->name = $request->get('name');
        $category->parent_id = $request->get('parent') ?? 0;
        $category->image = $path;
        $category->description = $request->get('description');
        $category->save();

        return redirect()->route('admin.categories.index', ['type' => $request->get('type')])->with('success', trans('categories.created'));
    }

    /**
     * @param Category $category
     * @return Factory|View
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'mainCategories' => Category::whereParentId(0)->where('id', '<>', $category->id)->get(),
            'category' => $category,
        ]);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', new UniqueCategory($request->get('parent'), $id)],
            'parent' => ['nullable', 'exists:categories,id'],
            'image' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'description' => 'nullable|max:1024',
        ]);

        $path = $category->image;
        if ($request->file('image')) {
            $path = $request->file('image')->store('categories');
        }

        $category->name = $request->get('name');
        $category->parent_id = $request->get('parent') ?? 0;
        $category->image = $path;
        $category->description = $request->get('description');
        $category->save();

        return redirect()->route('admin.categories.index', ['type' => $category->type])->with('success', trans('categories.updated'));
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        // update children of deleted category
        Category::where('parent_id', $id)->update(['parent_id' => 0]);
        Product::where('category_id', $id)->update(['category_id' => 0]);

        return new JsonResponse(['message' => trans('categories.deleted')]);
    }
}
