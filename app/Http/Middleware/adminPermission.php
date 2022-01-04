<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Auth;
use Session;
use App\admin;
class adminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
            if (Session::get('admin_id')) {
                $ad=admin::where('admin_id',Session::get('admin_id'))->first();
                if ($ad->hasRole('admin')) {
                    return $next($request);
        }}
        return redirect()->back()->with('alert', 'Bạn không quyền thực hiện chức năng này');}
}
