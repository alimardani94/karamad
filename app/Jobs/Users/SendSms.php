<?php

namespace App\Jobs\Users;

use App\Services\SMS\SMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $cell;

    /**
     * @var string
     */
    private $body;

    /**
     * Create a new job instance.
     *
     * @param string $cell
     * @param string $body
     */
    public function __construct(string $cell, string $body)
    {
        $this->cell = $cell;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /** @var Sms $sms */
        $sms = app(Sms::class);
        $sms->send($this->cell, $this->body);
    }
}
