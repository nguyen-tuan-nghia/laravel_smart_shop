<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Visitors;
use App\product;
use App\post;
use App\order;
use App\customer;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('APP_ENV')!='local'){
            URL::ForceScheme('https');
        }
        view()->composer('*',function($view) {
            $web=DB::table('tbl_web_detail')->first();
            $min_price = product::min('product_price');
            $max_price = product::max('product_price');

            $min_price_range = $min_price + 500000;
            $max_price_range = $max_price + 10000000;
            
            $app_product = product::all()->count();
            $app_post = post::all()->count();
            $app_order = order::all()->count();
            $app_customer = customer::all()->count();
            $share_image = '';

            $view->with('min_price', $min_price )->with('max_price', $max_price )->with('min_price_range', $min_price_range )->with('max_price_range', $max_price_range )->with('app_product', $app_product )->with('app_post', $app_post )->with('app_order',$app_order)->with('app_customer', $app_customer )->with('share_image',$share_image)->with('web',$web);

        });

    }
}
