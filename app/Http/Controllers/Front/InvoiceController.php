<?php

namespace App\Http\Controllers\Front;

use App\Enums\InvoiceableStatus;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Services\Payment\Gateway;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    /**
     * @param Invoice $invoice
     * @return Application|Factory|View
     */
    public function show(Invoice $invoice)
    {
        return view('front.invoice', [
            'invoice' => $invoice,
        ]);
    }

    /**
     * @param Invoice $invoice
     * @return RedirectResponse
     * @throws Exception
     */
    public function pay(Invoice $invoice)
    {
        if ($invoice->status != InvoiceableStatus::Pending) {
            throw new Exception('this order is payed before');
        }

        $gateway = new Gateway('zarinpal');

        return redirect()->to($gateway->redirect(
            $invoice->amount,
            route('payment.callback', ['gateway' => 'zarinpal', 'invoice' => $invoice->id,])
        ));
    }
}
