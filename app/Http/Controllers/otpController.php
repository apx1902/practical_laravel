<?php

namespace App\Http\Controllers;

use App\Services\TwilioService;
use Illuminate\Http\Request;

class otpController extends Controller
{
    protected $twilio;

    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }

    public function sendOtp(Request $request){
        $request ->validate([
            'phone' => 'required',
        ]);

        $otp = rand(100000,999999);

        $this->twilio->sendOtp($request->phone, $otp);

        return response()->json([
            'otp' => $otp,
            'message' => 'OTP sent Successfully'
        ]);
    }
}
