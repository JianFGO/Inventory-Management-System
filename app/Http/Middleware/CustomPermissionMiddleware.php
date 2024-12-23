<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $permission, $guard = null)
    {
        $user = Auth::guard($guard)->user();

        if (! $user || ! $user->hasPermissionTo($permission)) {
            return redirect('/access-denied')->with('error', 'You do not have the necessary permissions.');
        }

        return $next($request);
    }
}
