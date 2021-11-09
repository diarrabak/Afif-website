<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array('admin', $request->session()->get('roles'))) {  //Only logged in admin can access the routes protected by this middleware
            return $next($request);
        }
        return redirect()->route('home');    //Other users are redirected to the home page
    }
}
