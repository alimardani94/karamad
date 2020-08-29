<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shop\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $orders = Order::orderByDesc('id')->paginate(10);

        return view('admin.order.index', [
            'orders' => $orders,
        ]);
    }


}
