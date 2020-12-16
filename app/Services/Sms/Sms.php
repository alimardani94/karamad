<?php

namespace App\Services\Sms;

interface Sms
{
    /**
     * send SMS to single phone
     *
     * @param string $phone
     * @param string $body
     */
    public function send(string $phone, string $body);

    /**
     * get array of received SMS from users
     *
     * @return array
     */
    public function received(): array;

    /**
     * get SMS provider balance
     *
     * @return int
     */
    public function balance(): int;
}
