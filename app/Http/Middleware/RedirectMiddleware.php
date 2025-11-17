<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('freelancer_web')->check()) {
            return redirect()->route('freelancer.home');
        }

        if (auth('client_web')->check()) {
            return redirect()->route('client.home');
        }

        return $next($request);
    }
}
