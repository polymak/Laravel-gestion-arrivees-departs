<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registre les services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap les services.
     *
     * @return void
     */
    public function boot()
    {
        // Utiliser la pagination de Bootstrap
        Paginator::useBootstrap();
    }
}

