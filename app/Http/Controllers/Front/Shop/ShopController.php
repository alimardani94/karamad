<?php

namespace App\Http\Controllers\Front\Shop;

use App\Enums\Shop\ProductStatus;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $products = Product::whereStatus(ProductStatus::CONFIRMED)->with('owner.school')->paginate();

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
        $product = Product::whereId($id)->with(['comments', 'owner.school'])->withCount('comments')->firstOrFail();

        if ($product->status != ProductStatus::CONFIRMED and Auth::user()->isAdmin() == false) {
            abort(404);
        }

        $relatedProducts = Product::whereStatus(ProductStatus::CONFIRMED)->where('id', '<>', $id)->with('owner.school')->limit(6)->get();

        return view('pages.front.shop.product', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
