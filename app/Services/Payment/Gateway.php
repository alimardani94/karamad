<?php


namespace App\Services\Payment;


use App\Models\Invoice;
use App\Services\Payment\Exceptions\PaymentGatewayException;
use Illuminate\Http\Request;

class Gateway
{
    private $gateway;

    /**
     * Gateway constructor.
     * @param $gateway
     */
    public function __construct($gateway)
    {
        $className = 'App\Services\Payment\\' . ucfirst($gateway);
        $this->gateway = new $className;
    }

    /**
     * get link to redirect
     *
     * @param int $price
     * @param string $callbackURL
     * @return string
     */
    public function redirect(int $price, string $callbackURL): string
    {
        return $this->gateway->redirect($price, $callbackURL);
    }

    /**
     * @param Request $request
     * @param Invoice $invoice
     * @return mixed
     */
    public function verify(Request $request, Invoice $invoice)
    {
        return $this->gateway->verify($request, $invoice);
    }
}
