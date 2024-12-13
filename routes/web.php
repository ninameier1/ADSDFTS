<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\BusTicketController;
use Illuminate\Support\Facades\Route;

// Bus, Festival, and BusTicket CRUD routes
Route::middleware(['auth','admin'])->group(function () {
    Route::resource('buses', BusController::class);
    Route::resource('festivals', FestivalController::class);
    Route::resource('bus-tickets', BusTicketController::class);
});

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route (requires authentication)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';
