<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement; // import announcement model

class MemberDashboardController extends Controller
{

// function to view announcements posted by the admin 
    public function index() {
        $announcements = Announcement::with('zone')->latest()->get();

        return view('member.dashboard', compact('announcements'));
    }
    
}
