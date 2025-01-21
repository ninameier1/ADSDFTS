<?php

use App\Http\Controllers\Admin\BusController as AdminBusController;
use App\Http\Controllers\Admin\BusTicketController as AdminBusTicketController;
use App\Http\Controllers\Admin\FestivalController as AdminFestivalController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;

// Admin panel CRUD routes
Route::prefix('admin')->group(function ()
    {
        Route::resource('buses', AdminBusController::class);
        Route::resource('festivals', AdminFestivalController::class);
        Route::resource('bustickets', AdminBusTicketController::class);
    })->middleware(isAdmin::class); // Keep it secret, keep it safe

// Customer routes
Route::resource('buses', BusController::class);
Route::resource('festivals', FestivalController::class);
Route::resource('bustickets', BusTicketController::class);


// Homepage
Route::get('/', function ()
    {
        return view('welcome');
    })->name('welcome')->middleware(isAdmin::class);


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
