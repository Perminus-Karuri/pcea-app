<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// import contribution type model
use App\Models\ContributionType;

class ContributionTypeController extends Controller
{
    // Function to display all contribution types
    public function index() {
        $types = ContributionType::latest()->get(); // gets contribution types and orders them by the newest

        return view('admin.contribution-types', compact('types'));
    }

    // Function to store validated contribution types
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:contribution_types,name',
        ]);

        ContributionType::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.contribution-types')->with('message', 'Contribution type has beeen successfully created'); // redirects with a success message
    }

    // Function to delete a contribution type
    public function destroy(ContributionType $contributionType) {
        $contributionType->delete();

        return redirect()->route('admin.contribution-types')->with('message', 'Contribution type was successfully deleted');
    }
}
