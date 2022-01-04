<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('has_role',function($expresstion){
            if (Auth::user()) {
                if (Auth::user()->hasRole($expresstion)) {
                    return true;
                }
                return false;
            }
        });
        Blade::if('hasany_role',function($expresstion){
            if (Auth::user()) {
                if (Auth::user()->hasAnyRoles($expresstion)) {
                    return true;
                }
                return false;
            }
        });
    }
}
