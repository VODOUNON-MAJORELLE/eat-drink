<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntrepreneurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        // Si l'utilisateur est entrepreneur mais n'est pas approuvé, il ne peut accéder qu'à la page statut
        if ($user && $user->role === 'entrepreneur' && $user->statut !== 'approuve') {
            if (!$request->routeIs('entrepreneur.statut')) {
                return redirect()->route('entrepreneur.statut');
            }
        }
        return $next($request);
    }
} 