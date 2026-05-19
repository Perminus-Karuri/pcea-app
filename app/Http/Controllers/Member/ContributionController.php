<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Models\ContributionType;

class ContributionController extends Controller
{
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

        Contribution::create([
            'user_id' => auth()->id(),
            'contribution_type_id' => $request->contribution_type_id,
            'phone' => $phone,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->route('member.contributions')->with('success', 'Request created successfully, payment is being processed...');
    }
}
