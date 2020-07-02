<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Enums\CategoryType;
use App\Enums\Shop\ProductType;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Shop\Product;
use App\Models\Tag;
use Auth;
use Exception;
use File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $categories = Category::where('parent_id', '<>', 0)
            ->where('type', CategoryType::Shop)->get();

        return view('admin.product.create', [
            'tags' => Tag::all(),
            'categories' => $categories,
            'types' => ProductType::translatedAll(),
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
            'name' => ['required', 'unique:products'],
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'category' => ['required', 'exists:categories,id'],
            'type' => ['required'],
            'file' => [
                Rule::requiredIf((int)$request->get('type') == ProductType::Digital),
                'mimes:mp3,mpga,wav,mp4,mov,ogg,qt,jpeg,bmp,png,gif,svg,pdf,zip,rar,pdf'
            ],
            'quantity' => [Rule::requiredIf((int)$request->get('type') == ProductType::Physical)],
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'attachment' => [
                'nullable', 'mimes:mp3,mpga,wav,mp4,mov,ogg,qt,jpeg,bmp,png,gif,svg,pdf,zip,rar', 'max:100000',
            ],
            'images' => 'required|array',
            'features' => 'nullable|array',
            'description' => 'required|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string|min:135|max:160',
        ]);

        foreach ($request->get('images') as $tempPath) {
            $newPath = str_replace('temp', 'products', $tempPath);
            chmod('media/' . $tempPath, 0777);

            File::move('media/' . $tempPath, 'media/' . $newPath);

            dd($tempPath, file_exists('media/' . $tempPath), $newPath);
        }


        if ($request->file('attachment')) {
            $attachPath = $request->file('attachment')->store('products/attachment');
        }

        $product = new Product();
        $product->name = $request->get('name');
        $product->category_id = $request->get('category');
        $product->type = $request->get('type');
        $product->quantity = $request->get('quantity');
        $product->price = $request->get('price');
        $product->features = json_encode($request->get('features'));
        $product->description = preventXSS($request->get('description'));
        $product->images = json_encode($request->get('images'));
        $product->attachment = $attachPath ?? null;
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

        return redirect()->route('admin.shop.products.index')->with('success', trans('products.updated'));
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
