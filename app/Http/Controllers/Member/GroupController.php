<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;

class GroupController extends Controller
{
    public function index() {
        $groups = Group::latest()->get();

        $member = auth()->user()->load('groups');

        return view('member.groups', compact('groups', 'member'));
    }

    public function join(Request $request) {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
        ]);

        auth()->user()->groups()->syncWithoutDetaching([
            $request->group_id
        ]);

        return redirect()->route('member.groups')->with('success', 'You have joined this group');
    }

    public function leave(Group $group) {
        auth()->user()->groups()->detach($group->id);

        return redirect()->route('member.groups')->with('success', 'You have left this group');
    }
}
