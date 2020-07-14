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

    public function product(Request $request, $id) {
        $product = Product::findOrFail($id);

        return view('shop.product', [
            'product' => $product,
        ]);
    }
}
