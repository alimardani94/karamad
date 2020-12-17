<?php

namespace App\Http\Controllers\Front;

use App\Enums\InvoiceableStatus;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Province;
use App\Models\UserAddress;
use App\Services\Payment\Gateway;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    /**
     * @param Invoice $invoice
     * @return Application|Factory|View
     */
    public function show(Invoice $invoice)
    {
        $provinces = Province::all();
        $address = null;

        if ($invoice->invoiceable_type == Order::class) {
            /** @var Order $order */
            $order = $invoice->invoiceable;
            $address = $order->address;
        }

        return view('pages.front.invoice', [
            'invoice' => $invoice,
            'provinces' => $provinces,
            'address' => $address,
        ]);
    }

    /**
     * @param Invoice $invoice
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function pay(Invoice $invoice, Request $request)
    {
        $address = $invoice->invoiceable_type == Order::class;
        $request->validate([
            'province' => [Rule::requiredIf($address), 'exists:provinces,id'],
            'city' => [Rule::requiredIf($address), 'exists:cities,id'],
            'address' => [Rule::requiredIf($address), 'string', 'max:150'],
            'postal_code' => ['nullable', 'string', 'max:150'],
            'name' => [Rule::requiredIf($address), 'string', 'max:150'],
        ]);

        if ($invoice->status != InvoiceableStatus::Pending) {
            throw new Exception('this order is payed before');
        }

        if ($address) {
            $userAddress = new UserAddress();
            $userAddress->user_id = $invoice->user_id;
            $userAddress->province_id = $request->get('province');
            $userAddress->city_id = $request->get('city');
            $userAddress->address = $request->get('address');
            $userAddress->postal_Code = $request->get('postal_code');
            $userAddress->name = $request->get('name');
            $userAddress->save();

            /** @var Order $order */
            $order = $invoice->invoiceable;
            $order->address_id = $userAddress->id;
            $order->save();
        }

        $gateway = new Gateway('zarinpal');

        return redirect()->to($gateway->redirect(
            $invoice->amount,
            route('payment.callback', ['gateway' => 'zarinpal', 'invoice' => $invoice->id,])
        ));
    }
}
