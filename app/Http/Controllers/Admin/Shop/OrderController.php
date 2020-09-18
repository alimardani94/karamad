<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Enums\InvoiceableStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

    public function ChangeStatus(Order $order, Request $request)
    {
        $request->validate([
            'status' => ['required', Rule::in(InvoiceableStatus::all())],
        ]);

        if ($order->status == InvoiceableStatus::Payed) {
            $order->status = InvoiceableStatus::Shipped;
            $order->save();

            return new JsonResponse(['message' => 'status changed to shipped']);
        }

        return new JsonResponse(['message' => 'this method works for payed orders']);
    }

}
