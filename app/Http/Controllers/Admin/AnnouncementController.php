<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index() {
        $announcements = Announcement::with('user')->latest()->get();

        return view('admin.announcements', compact('announcements'));
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
        ]);

        //redirect with a success message
        return redirect()->route('admin.announcements')->with('success', 'Announcement posted successfully');
    }

    public function update(Request $request, Announcement $announcement) {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $announcement->update([
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return redirect()->route('admin.announcements')->with('success', 'Updated successfully');
    }

    public function destroy(Announcement $announcement) {
        $announcement->delete();

        return redirect()->route('admin.announcements')->with('success', 'Deleted successfully');
    }
}
