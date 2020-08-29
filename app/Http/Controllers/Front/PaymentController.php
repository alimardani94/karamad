<?php

namespace App\Http\Controllers\Front;

use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Services\Payment\Gateway;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request, string $gateway, Invoice $invoice)
    {
        $gateway = new Gateway($gateway);

        $transaction = new Transaction();
        $transaction->user_id = $invoice->user_id;
        $transaction->invoice_id = $invoice->id;
        $transaction->amount = $invoice->amount;

        try {
            $result = $gateway->verify($request, $invoice);

            $transaction->status = TransactionStatus::Success;
            $transaction->meta = json_encode([
                'card_number' => '',
                'tracking_code' => '',
                'ref_id' => '',
            ]);

            dd($result, $transaction);

        } catch (Exception $e) {

            $transaction->status = TransactionStatus::Failed;
            $transaction->meta = json_encode([
                'card_number' => '',
                'tracking_code' => '',
                'ref_id' => '',
            ]);

            dd($e, $transaction);
        }

        $transaction->save();

        return redirect()->route('dashboard.home');
    }
}
