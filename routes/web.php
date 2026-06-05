<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminDashboardController;  // import AdminDashboard controller
use App\Http\Controllers\Member\MemberDashboardController;  // import MemberDashboard controller
use App\Http\Controllers\Admin\ZoneController; // import admin Zone controller
use App\Http\Controllers\Member\ZoneController as MemberZoneController; // import member zone controller and gave it an alias
use App\Http\Controllers\Admin\AnnouncementController; // import admin announcement cotroller
use App\Http\Controllers\Admin\GroupController; // import admin group controller
use App\Http\Controllers\Member\GroupController as MemberGroupController; // import member group controller and gave it an alias
use App\Http\Controllers\Admin\ContributionTypeController; // import admin contribution type controller
use App\Http\Controllers\Admin\ContributionController; // import admin contribution controller
use App\Http\Controllers\Member\ContributionController as MemberContributionController; // import member contribution controller and gave it an alias

// Default route that redirects user to the login page
Route::get('/', function () {
    return redirect()->route('login');
});

/* Dashboard redirect route: 
    user with role admin is redirected to admin dashboard
    user with member role is redirected to member dashboard
*/
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('member.dashboard');
})->middleware('auth')->name('dashboard');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {


    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');  // route for displaying admin dashboard

    Route::get('/admin/zones', [ZoneController::class, 'index'])->name('admin.zones');  // route for displaying all the zones

    Route::post('/admin/zones', [ZoneController::class, 'store'])->name('admin.zones.store');  //  route for creating new zones

    Route::delete('/admin/zones/{zone}', [ZoneController::class, 'destroy'])->name('admin.zones.delete');  // route for deleting created zones

    Route::get('/admin.announcements', [AnnouncementController::class, 'index'])->name('admin.announcements'); // route for displaying posted announcements

    Route::post('/admin/announcements', [AnnouncementController::class, 'store'])->name('admin.announcements.store');  // route for adding new announcements

    Route::put('/admin/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('admin.announcements.update'); // route for editing an existing announcement

    Route::delete('/admin/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('admin.announcements.delete'); // route to delete an announcement

    Route::get('/admin/groups', [GroupController::class, 'index'])->name('admin.groups'); // route for displaying all the groups

    Route::post('admin/groups', [GroupController::class, 'store'])->name('admin.groups.store'); // route for creating a new group/groups

    Route::delete('/admin/groups{group}', [GroupController::class, 'destroy'])->name('admin.groups.delete'); // route for deleting a group/groups

    Route::get('/admin/contribution-types', [ContributionTypeController::class, 'index'])->name('admin.contribution-types'); // route for displaying all contribution types

    Route::post('/admin/contribution-types', [ContributionTypeController::class, 'store'])->name('admin.contribution-types.store'); // route for creating new contribution types

    Route::delete('/admin/contribution-types/{contributionType}', [ContributionTypeController::class, 'destroy'])->name('admin.contribution-types.delete'); // route for deleting a selected contribution type

    Route::get('/admin/contributions', [ContributionController::class, 'index'])->name('admin.contributions'); // route for displaying all contributions made

});

// Member routes
Route::middleware(['auth', 'role:member'])->group(function () {

    Route::get('/member/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');  // route for displaying the member landing page/dashboard

    Route::get('/member/zones', [MemberZoneController::class, 'index'])->name('member.zones'); // route for displaying available zones

    Route::post('/member/zones/join', [MemberZoneController::class, 'join'])->name('member.zones.join'); // route for joing a zone

    Route::post('member/zones/leave', [MemberZoneController::class, 'leave'])->name('member.zones.leave'); // route for leaving a zone

    Route::get('/member/groups', [MemberGroupController::class, 'index'])->name('member.groups'); // route for displaying available groups

    Route::post('member/groups/join', [MemberGroupController::class, 'join'])->name('member.groups.join'); // route for joining a group

    Route::post('/member/groups/{group}/leave', [MemberGroupController::class, 'leave'])->name('member.groups.leave'); // route for leaving a group

    Route::get('/member/contributions', [MemberContributionController::class, 'index'])->name('member.contributions'); // route for viewing personal contribution history

    Route::post('/member/contributions', [MemberContributionController::class, 'store'])->name('member.contributions.store'); // route for making a new contribution and store it in the database

});

// Shared authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
