<?php

namespace App\Providers;

use App\Models\Festival;
use App\Observers\FestivalObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\BusTicket;
use App\Observers\BusTicketObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Observe those sales baby
        BusTicket::observe(BusTicketObserver::class);
        // Observe them festivals being created
        Festival::observe(FestivalObserver::class);
    }
}
