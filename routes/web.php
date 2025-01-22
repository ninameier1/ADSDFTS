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


Route::get('/admin', function ()
    {
        return view('admin/dashboard');
    })->name('admin.dashboard')->middleware('admin');

// Admin panel CRUD routes
Route::prefix('admin')->middleware('admin')->group(function () // Keep it secret, keep it safe
    {
        $resources = [
            'buses' => AdminBusController::class,
            'festivals' => AdminFestivalController::class,
            'bustickets' => AdminBusTicketController::class,
        ];

        foreach ($resources as $resource => $controller) {
            Route::resource($resource, $controller, [
                'names' => [
                    'index' => "admin.{$resource}.index",
                    'show' => "admin.{$resource}.show",
                    'create' => "admin.{$resource}.create",
                    'store' => "admin.{$resource}.store",
                    'edit' => "admin.{$resource}.edit",
                    'update' => "admin.{$resource}.update",
                    'destroy' => "admin.{$resource}.destroy",
                ],
            ]);
        }
    });

// Customer CRUD routes
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

Route::get('/faq', function ()
    {
        return view('service/faq');
    })->name('faq');

Route::get('/privacy-policy', function ()
    {
        return view('service/privacy-policy');
    })->name('privacy-policy');

Route::get('/terms-of-service', function ()
    {
        return view('service/terms-of-service');
    })->name('terms-of-service');

// Auth routes
require __DIR__.'/auth.php';
