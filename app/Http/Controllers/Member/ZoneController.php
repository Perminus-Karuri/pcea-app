<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\User;

class ZoneController extends Controller
{
    // displays the zone page
    public function index() {
        $zones = Zone::latest()->get();  // gets all zones with the latest one appearing first

        $member = auth()->user()->load('zone'); // gets a logged in member and load their zone relationship

        $zoneMembers = collect(); // empty collection for zone members

        // gets other zone members if logged in member belongs to this zone
        if ($member->zone_id) {
            $zoneMembers = User::where('role', 'member')
                ->where('zone_id', $member->zone_id)
                ->where('id', '!=', $member->id)
                ->get();
        }

        // returns view with the required data
        return view('member.zones', compact(
            'zones',
            'member',
            'zoneMembers'
        ));
    }

    // join zone function
    public function join(Request $request) {
        // validate zone collection
        $request->validate([
            'zone_id' => 'required|exists:zones,id',
        ]);

        // assign selected zone to the authenticated user/member
        $request->user()->update([
            'zone_id' => $request->zone_id,
        ]);

        // redirect back to zones page with success message
        return redirect()->route('member.zones')->with('success', 'You have joined the zone successfully.');
    }

    // leave zone function
    public function leave() {
        // removes member/user from the current zone
        auth()->user()->update([
            'zone_id' => null,
        ]);

        // redirect back to zones page with success message
        return redirect()->route('member.zones')->with('success', 'You have left the zone sucessfully');
    }
    
}
