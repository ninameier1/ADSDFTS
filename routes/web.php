<?php

use App\Http\Controllers\Admin\BusController as AdminBusController;
use App\Http\Controllers\Admin\BusTicketController as AdminBusTicketController;
use App\Http\Controllers\Admin\FestivalController as AdminFestivalController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusTicketController;
use App\Http\Controllers\BusController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;

// Admin panel CRUD routes
Route::prefix('admin')->group(function ()
    {
        Route::resource('buses', AdminBusController::class,
        ['names' => [
            'index' => 'admin.buses.index',
            'show' => 'admin.buses.show',
            'create' => 'admin.buses.create',
            'store' => 'admin.buses.store',
            'edit' => 'admin.buses.edit',
            'update' => 'admin.buses.update',
            'destroy' => 'admin.buses.destroy',
        ]]);
        Route::resource('festivals', AdminFestivalController::class,
            ['names' => [
            'index' => 'admin.festivals.index',
            'show' => 'admin.festivals.show',
            'create' => 'admin.festivals.create',
            'store' => 'admin.festivals.store',
            'edit' => 'admin.festivals.edit',
            'update' => 'admin.festivals.update',
            'destroy' => 'admin.festivals.destroy',
        ]]);
        Route::resource('bustickets', AdminBusTicketController::class,
            ['names' => [
                'index' => 'admin.bustickets.index',
                'show' => 'admin.bustickets.show',
                'create' => 'admin.bustickets.create',
                'store' => 'admin.bustickets.store',
                'edit' => 'admin.bustickets.edit',
                'update' => 'admin.bustickets.update',
                'destroy' => 'admin.bustickets.destroy',
            ]]);
    })->middleware('isAdmin'); // Keep it secret, keep it safe

// Customer routes
Route::resource('festivals', FestivalController::class);
Route::resource('buses', BusController::class);
Route::resource('bustickets', BusTicketController::class);


// Homepage
Route::get('/', function ()
    {
        return view('welcome');
    })->name('welcome');


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
