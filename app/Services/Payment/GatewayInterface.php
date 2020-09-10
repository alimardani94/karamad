<?php

namespace App\Services\Payment;

use App\Models\Invoice;
use Illuminate\Http\Request;

interface GatewayInterface
{
    /**
     * get link to redirect
     *
     * @param int $price
     * @param string $callbackURL
     * @param string $description
     * @return string
     */
    public function redirect(int $price, string $callbackURL, string $description = ''): string;

    /**
     * @param Request $request
     * @param Invoice $invoice
     * @return mixed
     */
    public function verify(Request $request, Invoice $invoice);
}
