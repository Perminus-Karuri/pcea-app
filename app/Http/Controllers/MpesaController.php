<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Contribution;

class MpesaController extends Controller
{
    public function callback(Request $request)
    {
        Log::info($request->all());

        $callback = $request->Body['stkCallback'];

        $checkoutRequestID = $callback['CheckoutRequestID'];

        $resultCode = $callback['ResultCode'];

        // find contribution using checkout request id
        $contribution = Contribution::where('checkout_request_id', $checkoutRequestID)->first();

        if (!$contribution) {
            return response()->json([
                'ResultCode' => 1, 'ResultDesc' => 'Contribution not found'
            ]);
        }

        // successful payment
        if ($resultCode == 0) {

            $items = $callback['CallbackMetadata']['Item'];

            $receiptNumber = null;
            $transactionDate = null;

            foreach ($items as $item) {

                if ($item['Name'] == 'MpesaReceiptNumber') {
                    $receiptNumber = $item['Value'];
                }

                if ($item['Name'] == 'TransactionDate') {
                    $transactionDate = $item['Value'];
                }
            }

            $contribution->update([
                'status' => 'successful',
                'mpesa_receipt_number' => $receiptNumber,
                'transaction_date' => now(),
            ]);

        } else {

            // failed/cancelled payment
            $contribution->update([
                'status' => 'failed',
            ]);
        }

        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Callback processed successfully'
        ]);
    }
}