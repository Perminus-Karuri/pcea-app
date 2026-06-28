<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MpesaService
{
    // function to generate OAuth token for API authentication
    public function accessToken()
    {
        $consumerKey = config('services.daraja.consumer_key');
        $consumerSecret = config('services.daraja.consumer_secret');

        // Daraja endpoint for generating OAuth token
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $response = Http::withoutVerifying()
            ->withBasicAuth($consumerKey, $consumerSecret)
            ->get($url);

        return $response['access_token'];
    }

    // function to initiate STK Push request
    public function stkPush($phone, $amount, $accountReference, $transactionDesc)
    {
        $token = $this->accessToken();

        $shortcode = config('services.daraja.shortcode'); // paybill number
        $passkey = config('services.daraja.passkey');
        $timestamp = now()->format('YmdHis');

        $password = base64_encode($shortcode . $passkey . $timestamp);

        // Daraja endpoint for STK Push request
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        return Http::withoutVerifying()->withToken($token)->post($url, [
            'BusinessShortCode' => $shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => (int) $amount,
            'PartyA' => $phone,
            'PartyB' => $shortcode,
            'PhoneNumber' => $phone,
            'CallBackURL' => config('services.daraja.callback_url'),
            'AccountReference' => $accountReference,
            'TransactionDesc' => $transactionDesc,
        ])->json();
    }
}