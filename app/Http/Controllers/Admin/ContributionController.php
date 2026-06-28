<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// import contribution and contribution type models
use App\Models\Contribution;
use App\Models\ContributionType;

class ContributionController extends Controller
{
    public function index(Request $request) {
        // get contribution types and order them from latest to oldest
        $types = ContributionType::latest()->get();

        $query = Contribution::with(['user', 'contributionType'])
        ->when($request->filled('type'), function ($query) use ($request) {
            $query->where('contribution_type_id', $request->type);
        })
        ->when($request->filled('from_date'), function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }) // filter by start date
        ->when($request->filled('to_date'), function ($query) use ($request) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }); // filter by end date
        
        $contributions = $query->latest()->get(); // get contributions and order them from latest to oldest

        // calculates total successful contributions
        $totalAmount = $contributions->where('status', 'successful')->sum('amount');

        // calculates total failed contributions
        $totalFailedAmount = $contributions->where('status', 'failed')->sum('amount');

        return view('admin.contribution', compact(
            'contributions',
            'types',
            'totalAmount',
            'totalFailedAmount'
        )); // returns view of all contributions, types, total amount and total failed amount
    }
}
