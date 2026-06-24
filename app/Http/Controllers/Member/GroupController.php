<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Group; // import group model
use App\Models\User; // import user model
use App\Models\Announcement; // import announcement model

class GroupController extends Controller
{
    // Function to display groups that members can join
    public function index() {
        $groups = Group::latest()->get(); // get the groups and order them by newest

        $announcements = Announcement::latest()->get();

        $member = auth()->user()->load('groups', 'groups.users', 'groups.announcements');

        return view('member.groups', compact('groups', 'member', 'announcements'));
    }

    // Function to allow members to join groups 
    public function join(Request $request) {

        // check whether the group exists in the database
        $request->validate([
            'group_id' => 'required|exists:groups,id',
        ]);

        // add member to a group and uses syncWithoutDetaching to prevent duplicate entries
        auth()->user()->groups()->syncWithoutDetaching([
            $request->group_id
        ]);

        return redirect()->route('member.groups')->with('success', 'You have joined this group'); // redirect back to groups page with a success message
    }

    // Function that allows a member to leave a group 
    public function leave(Group $group) {
        auth()->user()->groups()->detach($group->id); // detach removes member from the pivot table

        return redirect()->route('member.groups')->with('success', 'You have left this group'); // redirect back to groups page with a success message
    }
}
