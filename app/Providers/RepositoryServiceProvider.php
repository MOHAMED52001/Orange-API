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
            'App\Http\Interfaces\SkillInterface',
            'App\Http\Repositories\SkillRepository'
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

        $this->app->bind(
            'App\Http\Interfaces\SupplierInterface',
            'App\Http\Repositories\SupplierRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\SupplierContractsInterface',
            'App\Http\Repositories\SupplierContractsRepository'
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
