<?php

namespace App\Dog;

use Illuminate\Support\ServiceProvider;

class DogServiceProvider extends ServiceProvider
{
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
        $this->app->singleton('snoopy', function ($app) {
            return new Dog();
        });
    }
}
