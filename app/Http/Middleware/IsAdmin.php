<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user has an admin role
        if (auth()->check() && auth()->user()->role !== 'admin') {
            // If the user is not an admin, redirect them back to the homepage
            return redirect('/');
        }

        return $next($request);
    }
}
