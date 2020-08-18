<?php

namespace App\Http\Controllers\Front\Shop;

use App\Enums\Shop\ProductType;
use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * @param Request $request
     * @param Product $product
     * @param int $count
     * @return RedirectResponse
     */
    public function add(Request $request, Product $product, int $count)
    {
        $cart = Session::get('cart');

        if (isset($cart[$product->id]) and $product->type == ProductType::Physical) {
            $cart[$product->id] = $cart[$product->id] + 1;
        } else {
            $cart[$product->id] = 1;
        }

        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    /**
     * @return Application|Factory|View
     */
    public function show()
    {
        $cartItems = Session::get('cart');

        $items = [];
        foreach ($cartItems as $id => $qty) {
            $product = Product::findOrFail($id);

            $items[] = [
                'id' => $product->id,
                'name' => $product->name,
                'type' => $product->type,
                'image' => $product->image(),
                'price' => $product->price,
                'quantity' => $qty,
                'total_price' => $product->price * $qty,
            ];
        }

        $totalPrice = array_sum(array_column($items, 'total_price'));

        return view('shop.cart', [
            'items' => $items,
            'totalPrice' => $totalPrice,
        ]);
    }


}
