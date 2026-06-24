<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

// import models
use App\Models\Contribution;
use App\Models\ContributionType;
use App\Services\MpesaService;

class ContributionController extends Controller
{
    protected $mpesa;

    public function __construct(MpesaService $mpesa) {
        $this->mpesa = $mpesa;
    }

    // function to display contributions page 
    public function index() {
        $types = ContributionType::latest()->get();

        // fetch contribution history that belongs to the logged in member, orders them by the newest
        $contributions = Contribution::with('contributionType')->where('user_id', auth()->id())
            ->latest()->get();

        return view('member.contributions', compact('types', 'contributions'));
    }

    // function to store member contribution 
    public function store(Request $request) {
        $request->validate([
            'contribution_type_id' => ['required','exists:contribution_types,id'],
            'phone' => ['required', 'regex:/^(07|01)[0-9]{8}$/'], // validate that the phone number starts either with 07 or 01 followwed by 8 digits
            'amount' => ['required', 'numeric', 'min:1']
        ]);

        // get number input from member
        $phone = $request->phone;

        // convert member number to international format(254) for MPESA API
        if(substr($phone, 0, 1) == "0") {
            $phone = "254".substr($phone, 1);
        }

        // creating a contribution with a pending status
        $contribution = Contribution::create([
            'user_id' => auth()->id(),
            'contribution_type_id' => $request->contribution_type_id,
            'phone' => $phone,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        // get contribution type 
        $type = ContributionType::find($request->contribution_type_id);

        // send stk push
        $response = $this->mpesa->stkPush(
            $phone,
            $request->amount,
            $type->name,
            'Church Contribution'
        );

        Log::info('MPESA STK Response: ', $response);

        // save checkoutRequest id for callback verification
        if(isset($response['CheckoutRequestID'])) {
            $contribution->update([
                'checkout_request_id' => $response['CheckoutRequestID'],
            ]);

            return redirect()->route('member.contributions')->with('success', 'Mpesa prompt sent to your phone'); // Redirect back with a success message after the STK push request is accepted
        }

        return redirect()->back()->with('error', 'Mpesa payment initiation failed!');
    }
}
