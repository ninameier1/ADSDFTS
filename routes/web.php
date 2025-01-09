<?php

use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\BusTicketController;
use App\Http\Controllers\Admin\FestivalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Admin panel CRUD routes
Route::prefix('admin')->group(function ()
    {
        Route::resource('buses', BusController::class);
        Route::resource('festivals', FestivalController::class);
        Route::resource('bustickets', BusTicketController::class);
    })->middleware('isAdmin'); // Keep it secret, keep it safe

// Customer side CRUD routes
Route::prefix('customer')->namespace('App\Http\Controllers\Customer')->group(function () {
    Route::resource('buses', BusController::class);
    Route::resource('festivals', FestivalController::class);
    Route::resource('bustickets', BusTicketController::class);
});


// Homepage
Route::get('/', function ()
    {
        return view('welcome');
    });

// Dashboard route (requires authentication)
Route::get('/dashboard', function ()
    {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

// User profile routes
Route::middleware('auth')->group(function ()
    {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

// Auth routes
require __DIR__.'/auth.php';
