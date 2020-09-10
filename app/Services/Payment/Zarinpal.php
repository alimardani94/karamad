<?php

namespace App\Services\Payment;

use App\Models\Invoice;
use App\Services\Payment\Exceptions\PaymentGatewayException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoapClient;

class Zarinpal implements GatewayInterface
{
    /**
     * @var SoapClient|object
     */
    private $client;

    /**
     * Zarinpal constructor.
     */
    public function __construct()
    {
        $this->client = new SoapClient(config('payment.gateways.zarinpal.wsdl'), ['encoding' => 'UTF-8']);
    }

    /**
     * get link to redirect
     *
     * @param int $price
     * @param string $callbackURL
     * @param string $description
     * @return string
     * @throws PaymentGatewayException
     */
    public function redirect(int $price, string $callbackURL, string $description = ''): string
    {
        $result = $this->client->PaymentRequest(
            [
                'MerchantID' => config('payment.gateways.zarinpal.merchantID'),
                'Amount' => $price,
                'Description' => $description ?? config('app.name'),
                'Email' => Auth::user()->email,
                'Mobile' => Auth::user()->cell,
                'CallbackURL' => $callbackURL,
            ]
        );

        if ($result->Status == 100) {
            return 'https://www.zarinpal.com/pg/StartPay/' . $result->Authority;
        }

        throw new PaymentGatewayException('zarinpal gateway connection error');
    }

    /**
     * @param Request $request
     * @param Invoice $invoice
     * @return mixed
     * @throws PaymentGatewayException
     */
    public function verify(Request $request, Invoice $invoice)
    {
        if ($request->get('Status') == 'OK') {

            $result = $this->client->PaymentVerification([
                'MerchantID' => config('payment.gateways.zarinpal.merchantID'),
                'Authority' => $request->get('Authority'),
                'Amount' => $invoice->amount,
            ]);

            if ($result->Status == 100) {
                return [
                    'status' => $result->Status ?? '',
                    'ref_id' => $result->RefID ?? '',
                ];
            }

            throw new PaymentGatewayException('Transaction failed. Status:' . $result->Status);

        }

        throw new PaymentGatewayException('Transaction canceled by user');
    }
}
