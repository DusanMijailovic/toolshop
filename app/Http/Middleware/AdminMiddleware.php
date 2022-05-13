<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if($request->session()->has("user")){
            $user = $request->session()->get("user");

            if($user->role == "Administrator"){
                return $next($request);
            }
        }
        return redirect(route("home"));

    }
}
