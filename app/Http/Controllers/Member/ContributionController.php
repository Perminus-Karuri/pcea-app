<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Models\ContributionType;
use App\Services\MpesaService;

class ContributionController extends Controller
{
    protected $mpesa;

    public function __construct(MpesaService $mpesa) {
        $this->mpesa = $mpesa;
    }

    public function index() {
        $types = ContributionType::latest()->get();

        $contributions = Contribution::with('contributionType')->where('user_id', auth()->id())
            ->latest()->get();

        return view('member.contributions', compact('types', 'contributions'));
    }

    public function store(Request $request) {
        $request->validate([
            'contribution_type_id' => ['required','exists:contribution_types,id'],
            'phone' => ['required', 'regex:/^(07|01)[0-9]{8}$/'],
            'amount' => ['required', 'numeric', 'min:1']
        ]);

        // get number input from member
        $phone = $request->phone;

        // convert member number to international format(254) for MPESA API
        if(substr($phone, 0, 1) == "0") {
            $phone = "254".substr($phone, 1);
        }

        // creating a pending contribution
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

        // save checkout id
        if(isset($response['CheckoutRequestID'])) {
            $contribution->update([
                'checkout_request_id' => $response['CheckoutRequestID'],
            ]);

            return redirect()->route('member.contributions')->with('success', 'Mpesa prompt sent to your phone');
        }

        return redirect()->back()->with('error', 'Mpesa payment initiation failed!');
    }
}
