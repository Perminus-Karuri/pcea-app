<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\User;

class ZoneController extends Controller
{
    public function index() {
        $zones = Zone::latest()->get();

        $member = auth()->user()->load('zone');

        $zoneMembers = collect();

        if ($member->zone_id) {
            $zoneMembers = User::where('role', 'member')
                ->where('zone_id', $member->zone_id)
                ->where('id', '!=', $member->id)
                ->get();
        }

        return view('member.zones', compact(
            'zones',
            'member',
            'zoneMembers'
        ));
    }

    public function join(Request $request) {
        $request->validate([
            'zone_id' => 'required|exists:zones,id',
        ]);

        $request->user()->update([
            'zone_id' => $request->zone_id,
        ]);

        return redirect()->route('member.zones')->with('success', 'You have joined the zone successfully.');
    }
    
}
