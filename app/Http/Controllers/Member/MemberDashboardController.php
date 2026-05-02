<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class MemberDashboardController extends Controller
{

    public function index() {
        $announcements = Announcement::with('zone')->latest()->get();

        return view('member.dashboard', compact('announcements'));
    }
    
}
