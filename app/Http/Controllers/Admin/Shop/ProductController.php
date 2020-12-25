<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Enums\Shop\ProductStatus;
use App\Enums\Shop\ProductType;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        return view('pages.admin.product.index', [
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
        $categories = ProductCategory::where('parent_id', '<>', null)->get();
        $owners = User::whereHas('school')->select(['id', 'name', 'surname'])->get();

        return view('pages.admin.product.create', [
            'tags' => Tag::all(),
            'categories' => $categories,
            'owners' => $owners,
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
        $request->merge([
            'price' => parseNumber($request->get('price') ?? '0'),
            'discount' => parseNumber($request->get('discount') ?? '0'),
            'quantity' => $request->get('quantity') ? parseNumber($request->get('quantity') ?? '0') : null,
        ]);

        $request->validate([
            'name' => ['required'],
            'owner' => ['required', 'exists:users,id'],
            'category' => ['required', 'exists:product_categories,id'],
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
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

        $images = [];
        foreach ($request->get('images') as $tempPath) {
            $id = Product::latest('id')->first('id')->id ?? 0;
            $newPath = 'products/' . ($id + 1) . substr($tempPath, 15);

            Storage::move($tempPath, $newPath);

            $images[] = $newPath;
        }

        if ($request->file('attachment')) {
            $attachPath = $request->file('attachment')->store('products/attachments');
        }

        $product = new Product();
        $product->name = $request->get('name');
        $product->owner_id = $request->get('owner');
        $product->category_id = $request->get('category');
        $product->type = $request->get('type');
        $product->status = ProductStatus::CONFIRMED;
        if ($product->type == ProductType::Physical) {
            $product->quantity = $request->get('quantity');
        } else {
            if ($request->file('file')) {
                $file = $request->file('file')->store('products/files');
            }
            $product->file = $file ?? null;
        }
        $product->price = round($request->get('price'), -2);
        $product->discount = $request->get('discount');
        $product->features = json_encode($request->get('features') ?? []);
        $product->summery = $request->get('summery');
        $product->description = $request->get('description');
        $product->images = json_encode($images);
        $product->attachment = $attachPath ?? null;
        $product->meta_keywords = $request->get('meta_keywords');
        $product->meta_description = $request->get('meta_description');
        $product->save();

        $product->tags()->attach($request->get('tags'));

        return redirect()->route('admin.shop.products.index')->with('success', trans('products.created'));
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
        $categories = ProductCategory::where('parent_id', '<>', null)->get();
        $owners = User::whereHas('school')->select(['id', 'name', 'surname'])->get();

        return view('pages.admin.product.edit', [
            'product' => $product,
            'owners' => $owners,
            'tags' => Tag::all(),
            'categories' => $categories,
            'types' => ProductType::translatedAll(),
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
        $request->merge([
            'price' => parseNumber($request->get('price') ?? '0'),
            'discount' => parseNumber($request->get('discount') ?? '0'),
            'quantity' => $request->get('quantity') ? parseNumber($request->get('quantity') ?? '0') : null,
        ]);

        $request->validate([
            'name' => ['required'],
            'owner' => ['required', 'exists:users,id'],
            'category' => ['required', 'exists:product_categories,id'],
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'type' => ['required'],
            'file' => [
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

        $images = [];
        foreach ($request->get('images') as $img) {

            $oldImagesPrefix = asset('storage/') . '/';

            if (strpos($img, $oldImagesPrefix) !== false) {
                $images[] = str_replace($oldImagesPrefix, '', $img);
            } else {
                $newPath = 'products/' . $product->id . substr($img, 15);

                Storage::move($img, $newPath);

                $images[] = $newPath;
            }
        }

        if ($request->file('attachment')) {
            $attachPath = $request->file('attachment')->store('products/attachments');
        }

        $product->name = $request->get('name');
        $product->category_id = $request->get('category');
        $product->type = $request->get('type');
        $product->status = ProductStatus::CONFIRMED;
        if ($product->type == ProductType::Physical) {
            $product->quantity = $request->get('quantity');
        } else {
            if ($request->file('file')) {
                $attachPath = $request->file('file')->store('products/files');
            }
        }
        $product->price = round($request->get('price'), -2);
        $product->discount = $request->get('discount');
        $product->features = json_encode($request->get('features') ?? []);
        $product->summery = $request->get('summery');
        $product->description = $request->get('description');
        $product->images = json_encode($images);
        $product->attachment = $attachPath ?? null;
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
