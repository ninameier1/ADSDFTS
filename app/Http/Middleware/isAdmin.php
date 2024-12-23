<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user has an admin role
        if (auth()->check() && !auth()->user()->isAdmin()) {
            // If the user is not an admin, redirect them back to the homepage
            return redirect('/');
        }
        return $next($request); // Proceed to the next middleware or controller
    }
}
