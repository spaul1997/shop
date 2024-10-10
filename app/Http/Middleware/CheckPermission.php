<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        // Check if the session has 'permissions'
        $userPermissions = JWTAuth::user()->permission;

        // Check if any of the required permissions exist in the user's permissions
        foreach ($permissions as $permission) {
            if (in_array($permission, $userPermissions)) {
                return $next($request); // Allow access if any permission matches
            }
        }

        // If no matching permissions are found, deny access
        abort(403, 'You do not have permission to access this page.');
    }
}
