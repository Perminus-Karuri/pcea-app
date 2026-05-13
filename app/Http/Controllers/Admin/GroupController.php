<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;

class GroupController extends Controller
{
    public function index(Request $request) {
        $selectedGroup = $request->group_id;

        $groups = Group::withCount('users')->latest()->get();

        $members = User::where('role', 'member')->with('groups')
            ->when($selectedGroup, function ($query) use ($selectedGroup) {
            $query->whereHas('groups', function ($q) use ($selectedGroup) {
                $q->where('groups.id', $selectedGroup);
            });
        })->get();

        return view('admin.groups', compact('groups', 'members', 'selectedGroup'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:groups,name'
        ]);

        Group::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.groups')->with('success', 'The group was successfully created');
    }

    public function destroy(Group $group) {
        $group->delete();

        return redirect()->route('admin.groups')->with('success', 'The group was successfully deleted');
    }
}
