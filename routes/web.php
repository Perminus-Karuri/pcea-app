<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;  // added admin controller to able to access it in web.php
use App\Http\Controllers\Member\MemberDashboardController;  // added member controller to able to access it in web.php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('member.dashboard');
})->middleware('auth')->name('dashboard');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {


    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

});

// Member routes
Route::middleware(['auth', 'role:member'])->group(function () {

    Route::get('/member/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');

});

// Shared authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
