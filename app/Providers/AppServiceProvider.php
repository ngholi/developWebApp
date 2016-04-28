<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Model\Employee\EmployeeServiceInterface', 'App\Model\Employee\EmployeeService');
        $this->app->singleton('App\Model\Department\DepartmentServiceInterface', 'App\Model\Department\DepartmentService');
    }
}
