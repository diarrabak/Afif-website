<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        $request->session()->put('email', $request->email);
       

        if (!empty(session('email'))) {

            $user = User::where('email', session('email'))->first();
            /*dd($user);*/
            $request->session()->put('name', $user->name);
            //dd($user->roles);
            $role_list = [];
            $roles = $user->roles;
            foreach ($roles as $role) {
                $role_list[] = strtolower($role->name);
            }
            $request->session()->put('roles', $role_list);

        }
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
