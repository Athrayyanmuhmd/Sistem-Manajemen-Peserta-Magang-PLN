<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized. Please login first.'
                ], 401);
            }
            
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        
        // Check if user has any of the required roles
        if (!empty($roles) && !$this->userHasRole($user, $roles)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Forbidden. You do not have permission to access this resource.'
                ], 403);
            }
            
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }

    /**
     * Check if user has any of the required roles
     */
    private function userHasRole($user, array $roles): bool
    {
        // If user table has a 'role' column
        if (isset($user->role)) {
            return in_array($user->role, $roles);
        }

        // If using a separate roles system
        if (method_exists($user, 'hasRole')) {
            foreach ($roles as $role) {
                if ($user->hasRole($role)) {
                    return true;
                }
            }
        }

        // If using a roles relationship
        if (method_exists($user, 'roles')) {
            $userRoles = $user->roles()->pluck('name')->toArray();
            return !empty(array_intersect($roles, $userRoles));
        }

        // Default: allow access if no role system is implemented
        return true;
    }
}