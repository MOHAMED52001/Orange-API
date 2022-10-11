<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Interfaces\AdminInterface',
            'App\Http\Repositories\AdminRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\CourseInterface',
            'App\Http\Repositories\CourseRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
