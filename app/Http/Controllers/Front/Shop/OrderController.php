<?php

namespace App\Http\Controllers\Front\Shop;

use App\Enums\InvoiceableStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Services\PriceCalculator\Calculator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => ['required', 'array'],
        ]);
        $items = array_values($request->get('items', []));

        $ids_ordered = implode(',', array_column($items, 'id'));

        $products = Product::whereIn('id', array_column($items, 'id'))
            ->select(['id', 'name', 'type', 'price', 'file', 'images'])
            ->orderByRaw("FIELD(id, $ids_ordered)")
            ->get()->toArray();
        $products = array_merge_recursive_distinct($items, $products);

        $priceCalculator = app(Calculator::class);
        $totalPrice = $priceCalculator->calculate($products);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->products = json_encode($products);
        $order->total_price = $totalPrice;
        $order->status = InvoiceableStatus::Pending;
        $order->save();

        $request->session()->put('cart', []);

        return redirect()->route('dashboard.home', '#orders');
    }

}
