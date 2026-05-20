<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Models\ContributionType;

class ContributionController extends Controller
{
    public function index(Request $request) {
        $types = ContributionType::latest()->get();

        $contributions = Contribution::with(['user', 'contributionType'])
            ->when($request->type, function ($query) use ($request) {
                $query->where('contribution_type_id', $request->type);
            })->when($request->month, function ($query) use ($request) {
                $query->whereMonth('created_at', $request->month);
            })->when($request->year, function ($query) use ($request) {
                $query->whereYear('created_at', $request->year);
            })
        ->latest()->get();

        $totalAmount = Contribution::where('status', 'successful')
            ->when($request->type, function ($query) use ($request) {
                $query->where('contribution_type_id', $request->type);
            })
            ->when($request->month, function ($query) use ($request) {
                $query->whereMonth('created_at', $request->month);
            })
            ->when($request->year, function ($query) use ($request) {
                $query->whereYear('created_at', $request->year);
            })
        ->sum('amount');

        $totalAmount = $contributions->where('status', 'successful')->sum('amount');

        return view('admin.contribution', compact(
            'contributions',
            'types',
            'totalAmount'
        ));
    }
}
