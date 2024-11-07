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
        $this->app->bind(
            'App\Repositories\LoanRepositoryInterface',
            'App\Repositories\LoanRepository'
        );
        $this->app->bind(
            'App\Repositories\EmiRepositoryInterface',
            'App\Repositories\EmiRepository'
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
