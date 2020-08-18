<?php

namespace App\Http\Controllers\Front\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        $products = array_values($request->get('items'));

        $priceCalculator = app(Calculator::class);
        $totalPrice = $priceCalculator->calculate($products);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->products = json_encode($products);
        $order->total_price = $totalPrice;
        $order->status = 0;
        $order->save();

        return redirect()->route('dashboard.home');
    }

}
