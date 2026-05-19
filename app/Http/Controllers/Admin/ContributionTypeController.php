<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContributionType;

class ContributionTypeController extends Controller
{
    public function index() {
        $types = ContributionType::latest()->get();

        return view('admin.contribution-types', compact('types'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:contribution_types,name',
        ]);

        ContributionType::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.contribution-types')->with('message', 'Contribution type has beeen successfully created');
    }

    public function destroy(ContributionType $contributionType) {
        $contributionType->delete();

        return redirect()->route('admin.contribution-types')->with('message', 'Contribution type was successfully deleted');
    }
}
