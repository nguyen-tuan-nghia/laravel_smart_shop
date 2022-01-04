<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Auth;
class replyPermission
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
        if(Auth::id()){
        if (Auth::user()->hasAnyRoles(['admin','reply'])) {
                    return $next($request);
        }}
        return redirect()->back()->with('alert', 'Bạn không quyền thực hiện chức năng này');
    }
    
}
