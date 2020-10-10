<?php

namespace App\Http\Controllers\Front;

use App\Enums\InvoiceStatus;
use App\Enums\InvoiceableStatus;
use App\Enums\TransactionStatus;
use App\Events\InvoicePayed;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Transaction;
use App\Services\Payment\Gateway;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function callback(Request $request, string $gateway, Invoice $invoice)
    {
        $transaction = new Transaction();
        $transaction->user_id = $invoice->user_id;
        $transaction->invoice_id = $invoice->id;
        $transaction->amount = $invoice->amount;

        try {
            $gateway = new Gateway($gateway);
            $result = $gateway->verify($request, $invoice);

            DB::transaction(function () use ($result, $invoice, $transaction) {
                $transaction->status = TransactionStatus::Success;
                $transaction->meta = json_encode($result);
                $transaction->save();

                $invoice->status = InvoiceStatus::Payed;
                $invoice->save();

                /** @var Order $order */
                $order = $invoice->invoiceable;
                $order->status = InvoiceableStatus::Payed;
                $order->save();
            });

            event(new InvoicePayed($invoice));

        } catch (Exception $e) {
            $transaction->status = TransactionStatus::Failed;
            $transaction->meta = json_encode([
                'status' => $e->getMessage(),
            ]);
            $transaction->save();
        }

        return redirect()->route('dashboard.home');
    }
}
