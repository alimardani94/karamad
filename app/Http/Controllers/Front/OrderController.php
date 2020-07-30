<?php

namespace App\Http\Controllers\Front;

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
        dd($request);
        $products = $request->get('items');

        $priceCalculator = app(Calculator::class);
        $totalPrice = $priceCalculator->calculate($products);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->products = $products;
        $order->total_price = $totalPrice;
        $order->save();

        return redirect()->route('');
    }

}
