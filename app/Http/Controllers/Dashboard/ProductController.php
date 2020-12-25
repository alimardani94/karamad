<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\Shop\ProductStatus;
use App\Enums\Shop\ProductType;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
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

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'category' => ['required', 'exists:product_categories,id'],
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'quantity' => ['required'],
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'images' => 'required|array',
            'features' => 'nullable|array',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return Redirect::to(URL::previous() . "#create_product")->withErrors($validator)->withInput();
        }

        $images = [];
        foreach ($request->get('images') as $tempPath) {
            $id = Product::latest('id')->first('id')->id ?? 1;
            $newPath = 'products/' . $id . substr($tempPath, 15);

            Storage::move($tempPath, $newPath);

            $images[] = $newPath;
        }

        $product = new Product();
        $product->name = $request->get('name');
        $product->owner_id = Auth::id();
        $product->category_id = $request->get('category');
        $product->type = ProductType::Physical;
        $product->status = ProductStatus::PENDING;
        $product->quantity = $request->get('quantity');
        $product->price = round($request->get('price'), -2);
        $product->discount = $request->get('discount');
        $product->features = json_encode($request->get('features') ?? []);
        $product->summery = $request->get('summery');
        $product->description = $request->get('description');
        $product->images = json_encode($images);
        $product->meta_keywords = implode(',', $request->get('features'));
        $product->meta_description = substr($request->get('summery'), 0, 150);
        $product->save();

        $product->tags()->attach($request->get('tags'));

        return redirect()->route('admin.shop.products.index')->with('success', trans('products.created'));
    }
}
