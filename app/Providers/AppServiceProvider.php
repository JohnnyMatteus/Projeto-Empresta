<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Interfaces
        $this->app->bind(
            'App\Http\Interfaces\ICalculateSimulation',
            'App\Application\CalculateSimulation'
        );
        // Repositoryes
        $this->app->bind(
            'App\Http\Interfaces\IListInstituitions',
            'App\Infrastructure\PersistenceViaJson\InstiuitionsRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\IListCovenants',
            'App\Infrastructure\PersistenceViaJson\CovenantsRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\IListTaxasInstituitions',
            'App\Infrastructure\PersistenceViaJson\TaxaInstituitionsRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
