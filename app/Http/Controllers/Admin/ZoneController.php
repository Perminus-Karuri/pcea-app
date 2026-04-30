<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\User;

class ZoneController extends Controller
{
    // displays zones page
    public function index() {
        $zones = Zone::withCount('users')->get();  // get all zones and count users/members in each zone

        $members = User::with('zone')->get();  // get all users and their zone relationship

        return view('admin.zones', compact('zones', 'members'));  // return admin zone view with retrieved data
    }

    // storing new zones
    public function store(Request $request) {

        // validating zone name input
        $request->validate([
            'name' => 'required|string|unique:zones,name'
        ]);

        // creating a new zone record
        Zone::create([
            'name' => $request->name
        ]);

        return back()->with('success', 'Zone created successfully');  // redirecting back with a success message
    }

    // deleting added zones
    public function destroy(Zone $zone) {
        $zone->delete();  // deleting a selected zone

        return back()->with('success', 'Zone deleted successfully');  // redirecting back with success delete message
    }
}
