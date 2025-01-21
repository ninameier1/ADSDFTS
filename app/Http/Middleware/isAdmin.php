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
        if (!auth()->check() || !auth()->user()->isAdmin())
        {
            return redirect('/login');
        }
        return $next($request); // Proceed to the next middleware or controller
    }
}
