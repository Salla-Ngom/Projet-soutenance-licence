<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoCacheMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $reponses = $next($request);
        $reponses->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $reponses->headers->set('Pragma','no-cache');
        $reponses->headers->set('Expires', '0');
        return $reponses;
    }
}
