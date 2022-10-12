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
            'App\Http\Interfaces\TransactionsInterface',
            'App\Http\Repositories\TransactionsRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\InstructorInterface',
            'App\Http\Repositories\InstructorRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\StudentInterface',
            'App\Http\Repositories\StudentRepository'
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
