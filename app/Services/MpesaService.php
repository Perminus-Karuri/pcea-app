<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MpesaService
{
    public function accessToken()
    {
        $consumerKey = config('services.daraja.consumer_key');
        $consumerSecret = config('services.daraja.consumer_secret');

        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $response = Http::withoutVerifying()
            ->withBasicAuth($consumerKey, $consumerSecret)
            ->get($url);

        return $response['access_token'];
    }

    public function stkPush($phone, $amount, $accountReference, $transactionDesc)
    {
        $token = $this->accessToken();

        $shortcode = config('services.daraja.shortcode');
        $passkey = config('services.daraja.passkey');
        $timestamp = now()->format('YmdHis');

        $password = base64_encode($shortcode . $passkey . $timestamp);

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