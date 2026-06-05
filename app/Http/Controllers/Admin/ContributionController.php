<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Models\ContributionType;

class ContributionController extends Controller
{
    public function index(Request $request) {
        // get contribution types and order them from latest to oldest
        $types = ContributionType::latest()->get();

        // retrieve contributions made
        $contributions = Contribution::with(['user', 'contributionType'])
            ->when($request->type, function ($query) use ($request) {
                $query->where('contribution_type_id', $request->type); // filter by contribution type
            })->when($request->month, function ($query) use ($request) {
                $query->whereMonth('created_at', $request->month); // filter by month
            })->when($request->year, function ($query) use ($request) {
                $query->whereYear('created_at', $request->year); // filter by year
            })
        ->latest()->get(); // show newest contribution first

        // Calculates total successful contributions made
        $totalAmount = Contribution::where('status', 'successful')
            ->when($request->type, function ($query) use ($request) {
                $query->where('contribution_type_id', $request->type); // filter by contribution type
            })
            ->when($request->month, function ($query) use ($request) {
                $query->whereMonth('created_at', $request->month); // filter by month
            })
            ->when($request->year, function ($query) use ($request) {
                $query->whereYear('created_at', $request->year); // filter by year
            })
        ->sum('amount');

        $totalAmount = $contributions->where('status', 'successful')->sum('amount');

        return view('admin.contribution', compact(
            'contributions',
            'types',
            'totalAmount'
        )); // returns view of all contributions, types and total amount
    }
}
