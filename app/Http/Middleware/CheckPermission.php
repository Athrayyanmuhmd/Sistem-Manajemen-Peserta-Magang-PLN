<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $permission): Response
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
        
        // Check if user has the required permission
        if (!$this->userHasPermission($user, $permission)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Forbidden. You do not have permission to perform this action.'
                ], 403);
            }
            
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        return $next($request);
    }

    /**
     * Check if user has the required permission
     */
    private function userHasPermission($user, string $permission): bool
    {
        // Permission mapping based on roles
        $rolePermissions = [
            'super_admin' => ['*'], // Super admin has all permissions
            'admin' => [
                'interns.view', 'interns.create', 'interns.edit', 'interns.delete',
                'departments.view', 'departments.create', 'departments.edit', 'departments.delete',
                'universities.view', 'universities.create', 'universities.edit', 'universities.delete',
                'divisions.view', 'divisions.create', 'divisions.edit', 'divisions.delete',
                'reports.view', 'statistics.view'
            ],
            'supervisor' => [
                'interns.view', 'interns.edit',
                'departments.view', 'divisions.view', 'universities.view',
                'reports.view'
            ],
            'hr' => [
                'interns.view', 'interns.create', 'interns.edit',
                'departments.view', 'universities.view', 'divisions.view'
            ],
            'viewer' => [
                'interns.view', 'departments.view', 'universities.view', 'divisions.view'
            ]
        ];

        $userRole = $user->role ?? 'viewer';
        
        // Super admin has all permissions
        if ($userRole === 'super_admin') {
            return true;
        }

        $allowedPermissions = $rolePermissions[$userRole] ?? [];
        
        // Check if permission is in allowed permissions or if user has wildcard permission
        return in_array($permission, $allowedPermissions) || in_array('*', $allowedPermissions);
    }
}