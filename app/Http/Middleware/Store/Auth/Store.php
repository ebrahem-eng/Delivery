<?php

namespace App\Http\Middleware\Store\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Store
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('store')->check())
        {
          return redirect()->route('store.login.page')->with('error_message','Session Expired Login Again');
        }
        return $next($request);
    }
}
