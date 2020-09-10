<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\InvoiceStatus;
use App\Enums\InvoiceableStatus;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Services\Payment\Exceptions\PaymentGatewayException;
use App\Services\Payment\Gateway;
use App\Services\Payment\Zarinpal;
use Auth;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * @param Order $order
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            throw new AuthorizationException();
        }
        try {
            $order->delete();

            return new JsonResponse(['message' => trans('orders.deleted')]);
        } catch (Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * @param Order $order
     * @return RedirectResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function pay(Order $order)
    {
        if ($order->user_id != Auth::id()) {
            throw new AuthorizationException();
        }

        if($order->status != InvoiceableStatus::Pending) {
            throw new Exception('this order is payed before');
        }

        $invoice = Invoice::updateOrCreate([
            'user_id' => Auth::id(),
            'invoiceable_type' => Order::class,
            'invoiceable_id' => $order->id,
        ], [
            'amount' => $order->total_price,
            'gateway' => 'zarinpal',
            'status' => InvoiceStatus::Pending,
        ]);

        $gateway = new Gateway('zarinpal');

        return redirect()->to($gateway->redirect(
            $invoice->amount,
            route('payment.callback', ['gateway' => 'zarinpal', 'invoice' => $invoice->id,])
        ));
    }
}
