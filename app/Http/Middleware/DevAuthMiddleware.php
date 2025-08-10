<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DevAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): SymfonyResponse
    {
        // Check if user is already authenticated
        if (Auth::check()) {
            return $next($request);
        }

        // Check for development bypass session
        if (Session::get('auth_bypass')) {
            return $next($request);
        }

        // Redirect to login page if not authenticated
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
}