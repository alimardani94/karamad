<?php

namespace App\Http\Controllers\Front\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use Illuminate\Contracts\View\Factory;
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
}
