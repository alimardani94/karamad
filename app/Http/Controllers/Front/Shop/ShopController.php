<?php

namespace App\Http\Controllers\Front\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $products = Product::paginate();

        return view('shop.index', [
            'products' => $products,
        ]);
    }

    public function product(Request $request, $id)
    {
        $product = Product::whereId($id)->with('comments')->withCount('comments')->first();

        $relatedProducts = Product::where('id', '<>', $id)->limit(6)->get();

        return view('shop.product', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
