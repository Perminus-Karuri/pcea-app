<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Zone;

class AnnouncementController extends Controller
{
    public function index() {
        $announcements = Announcement::with('user', 'zone')->latest()->get();

        $zones = Zone::latest()->get();

        return view('admin.announcements', compact('announcements', 'zones'));
    }

    // storing announcements
    public function store(Request $request) {
        // validating input before storing
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // creating the announcement and storing it
        Announcement::create([
            'title' => $request->title,
            'message' => $request->message,
            'user_id' => auth()->id(),
            'zone_id' => $request->zone_id,
        ]);

        //redirect with a success message
        return redirect()->route('admin.announcements')->with('success', 'Announcement posted successfully');
    }

    public function update(Request $request, Announcement $announcement) {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'zone_id' => 'nullable|exists:zones,id',
        ]);

        $announcement->update([
            'title' => $request->title,
            'message' => $request->message,
            'zone_id' => $request->zone_id,
        ]);

        return redirect()->route('admin.announcements')->with('success', 'Updated successfully');
    }

    public function destroy(Announcement $announcement) {
        $announcement->delete();

        return redirect()->route('admin.announcements')->with('success', 'Deleted successfully');
    }
}
