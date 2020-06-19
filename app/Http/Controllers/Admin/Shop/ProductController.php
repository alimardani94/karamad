<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use App\Models\Shop\Tag;
use Auth;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $products = Product::paginate(10);

        return view('admin.product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.product.create', [
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
            'title' => ['required', 'unique:products'],
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'content' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png,gif,svg|max:4096',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string|min:135|max:160',
        ]);

        $path = $request->file('image')->store('products');

        $product = new Product();
        $product->title = $request->get('title');
        $product->content = preventXSS($request->get('content'));
        $product->image = $path;
        $product->author_id = Auth::id();
        $product->meta_keywords = $request->get('meta_keywords');
        $product->meta_description = $request->get('meta_description');
        $product->save();

        $product->tags()->attach($request->get('tags'));

        return redirect()->route('admin.products.index')->with('success', trans('products.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'product' => $product,
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => ['required', 'unique:products,title,' . $product->id],
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'content' => 'required',
            'image' => 'nullable|mimes:jpeg,bmp,png,gif,svg|max:4096',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string|min:135|max:160',
        ]);

        $path = $product->image;
        if ($request->file('image')) {
            $path = $request->file('image')->store('products');
        }

        $product->title = $request->get('title');
        $product->content = preventXSS($request->get('content'));
        $product->image = $path;
        $product->author_id = Auth::id();
        $product->meta_keywords = $request->get('meta_keywords');
        $product->meta_description = $request->get('meta_description');
        $product->save();

        $product->tags()->sync($request->get('tags'));

        return redirect()->route('admin.products.index')->with('success', trans('products.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        $product->tags()->detach();
        $product->delete();

        return new JsonResponse(['message' => trans('categories.deleted')]);
    }
}
