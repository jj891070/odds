<?php

namespace App\SobaMethod;

use Illuminate\Support\ServiceProvider;

class SobaServiceProvider extends ServiceProvider
{
    // protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('soba', function ($app) {
            $ss = new Soba();
            return $ss;
        });
    }
}
