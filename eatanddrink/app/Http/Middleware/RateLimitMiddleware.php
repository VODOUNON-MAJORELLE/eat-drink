<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'api:' . ($request->user()?->id ?: $request->ip());

        if (RateLimiter::tooManyAttempts($key, 60)) {
            return response()->json([
                'message' => 'Trop de requêtes. Veuillez réessayer plus tard.',
            ], 429);
        }

        RateLimiter::hit($key);

        return $next($request);
    }
} 