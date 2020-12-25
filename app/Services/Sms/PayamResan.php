<?php

namespace App\Services\Sms;

use App\Models\SmsLog;
use Exception;
use \SoapClient;
use SoapFault;

class PayamResan implements Sms
{
    /**
     * @var SoapClient
     */
    private $client;

    /**
     * Candoo constructor.
     * @throws SoapFault
     */
    public function __construct()
    {
        $this->client = new SoapClient(config('sms.drivers.payam_resan.wdsl'));
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function send(string $phone, string $body)
    {
        if (app()->environment('local')) {
            throw new Exception('you can not send sms in local environment');
        }

        $params = [
            'Username' => config('sms.drivers.payam_resan.username'),
            'PassWord' => config('sms.drivers.payam_resan.password'),
            'SenderNumber' => config('sms.drivers.payam_resan.source'),
            'MessageBodie' => $body,
            'destNo' => [$phone],
            'Type' => 1,
            'AllowedDelay' => 0,
        ];

        $result = $this->client->__call("SendMessage", $params);

        $sms_log = new SMSLog();
        $sms_log->number = $phone;
        $sms_log->body = $body;
        $sms_log->sms_id = $result->SendMessageResult[0];
        $sms_log->save();
    }

    /**
     * get array of received SMS from users
     *
     * @return array
     */
    public function received(): array
    {
        // TODO: Implement received() method.
    }

    /**
     * get SMS provider balance
     *
     * @return int
     */
    public function balance(): int
    {
        // TODO: Implement balance() method.
    }
}
