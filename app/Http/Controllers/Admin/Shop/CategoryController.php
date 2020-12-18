<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $categories = ProductCategory::paginate(10);

        return view('pages.admin.product_category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $categories = ProductCategory::whereParentId(null)->get();

        return view('pages.admin.product_category.create', [
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
            'name' => ['required'],
            'parent' => ['nullable', 'exists:categories,id'],
            'image' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'description' => 'nullable|max:1024',
        ]);

        $path = $request->file('image')->store('categories');

        $category = new ProductCategory();
        $category->name = $request->get('name');
        $category->parent_id = $request->get('parent') ?? 0;
        $category->image = $path;
        $category->description = $request->get('description');
        $category->save();

        return redirect()->route('admin.shop.categories.index', ['type' => $request->get('type')])->with('success', trans('categories.created'));
    }

    /**
     * @param ProductCategory $category
     * @return Factory|View
     */
    public function edit(ProductCategory $category)
    {
        return view('pages.admin.product_category.edit', [
            'mainCategories' => ProductCategory::whereParentId(null)->where('id', '<>', $category->id)->get(),
            'category' => $category,
        ]);
    }

    /**
     * @param Request $request
     * @param ProductCategory $category
     * @return RedirectResponse
     */
    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'name' => ['required'],
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

        return redirect()->route('admin.shop.categories.index')->with('success', trans('categories.updated'));
    }

    /**
     * @param ProductCategory $category
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(ProductCategory $category)
    {
        $category->delete();

        // update children of deleted category
        ProductCategory::where('parent_id', $category->id)->update(['parent_id' => null]);
        Product::where('category_id', $category->id)->update(['category_id' => null]);

        return new JsonResponse(['message' => trans('categories.deleted')]);
    }
}
