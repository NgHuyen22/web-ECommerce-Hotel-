<?php

// namespace App\Providers;

// use Illuminate\Support\ServiceProvider;

// class AppServiceProvider extends ServiceProvider
// {
//     /**
//      * Register any application services.
//      */
//     public function register(): void
//     {
//         //
//     }

//     /**
//      * Bootstrap any application services.
//      */
//     public function boot(): void
//     {
//         //
//     }

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ServiceType;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $svt;
    public function __construct()
    {
        $this -> svt = new ServiceType();
    }
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('customer.menu', function($view){
                $getServiceType = $this -> svt -> getServiceType();
                $view -> with(compact('getServiceType'));
        });
    }
}
