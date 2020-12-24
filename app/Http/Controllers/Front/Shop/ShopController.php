<?php

namespace App\Http\Controllers\Front\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
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
        $products = Product::with('owner.school')->paginate();

        return view('pages.front.shop.index', [
            'products' => $products,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function product(Request $request, $id)
    {
        $product = Product::whereId($id)->with(['comments', 'owner.school'])->withCount('comments')->first();
        $relatedProducts = Product::where('id', '<>', $id)->with('owner.school')->limit(6)->get();

        return view('pages.front.shop.product', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
