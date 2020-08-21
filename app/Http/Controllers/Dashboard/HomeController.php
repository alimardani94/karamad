<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $orders = Order::all();

        return view('dashboard.home', [
            'orders' => $orders,
        ]);
    }
}
