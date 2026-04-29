<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index() {

        // counts all members
        $totalMembers = User::where('role', 'member')->count();

        // get the members list
        $members = User::where('role', 'member')
                    ->select('name', 'phone', 'email')
                    ->latest()
                    ->get();

        return view('admin.dashboard', compact(
            'totalMembers', 'members'
        ));
    }
}
