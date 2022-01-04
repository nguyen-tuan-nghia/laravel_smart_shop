<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Session;
use App\admin;
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
            if (Session::get('admin_id')) {
                $ad=admin::where('admin_id',Session::get('admin_id'))->first();
                if ($ad->hasRole($expresstion)) {
                    return true;
                }
                return false;
            }
        });
        Blade::if('hasany_role',function($expresstion){
            if (Session::get('admin_id')) {
                $ad=admin::where('admin_id',Session::get('admin_id'))->first();
                if ($ad->hasAnyRoles($expresstion)) {
                    return true;
                }
                return false;
            }
        });
    }
}
