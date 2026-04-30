<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;  // added admin controller to able to access it in web.php
use App\Http\Controllers\Member\MemberDashboardController;  // added member controller to able to access it in web.php
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Member\ZoneController as MemberZoneController;


Route::get('/', function () {
    return redirect()->route('login');
});

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

});

// Member routes
Route::middleware(['auth', 'role:member'])->group(function () {

    Route::get('/member/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');  // route for displaying the member landing page/dashboard

    Route::get('/member/zones', [MemberZoneController::class, 'index'])->name('member.zones');

    Route::post('/member/zones/join', [MemberZoneController::class, 'join'])->name('member.zones.join');

});

// Shared authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
