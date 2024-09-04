<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class LoadPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permissions = session()->get('access_permissions', []);
        
        Gate::define('view-stage-list', function ($user) use ($permissions) {
            return in_array('view-stage-list', $permissions);
        });

        Gate::define('manage-data-entry', function ($user) use ($permissions) {
            return in_array('manage-data-entry', $permissions);
        });
        return $next($request);
    }
}
