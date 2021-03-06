<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Enums\InvoiceableStatus;
use App\Events\OrderShipped;
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

        return view('pages.admin.order.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * @param Order $order
     * @param Request $request
     * @return JsonResponse
     */
    public function changeStatus(Order $order, Request $request)
    {
        $request->validate([
            'status' => ['required', Rule::in(InvoiceableStatus::all())],
        ]);

        if ($order->status == InvoiceableStatus::Payed) {
            $order->status = InvoiceableStatus::Shipped;
            $order->save();

            event(new OrderShipped($order));

            return new JsonResponse(['message' => 'status changed to shipped']);
        }

        return new JsonResponse(['message' => 'this method works for payed orders']);
    }

}
