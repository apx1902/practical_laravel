<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendOtp($phone, $otp)
    {
        return $this->client->messages->create(
            $phone,
            [
                'from' => env('TWILIO_PHONE'),
                'body' => "Your OTP is: $otp"
            ]
        );
    }
}
