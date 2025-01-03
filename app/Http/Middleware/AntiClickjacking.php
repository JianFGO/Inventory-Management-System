<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AntiClickjacking
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
        $response = $next($request);

        // Add anti-clickjacking headers
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Content-Security-Policy', "frame-ancestors 'none';");

        return $response;
    }
}
