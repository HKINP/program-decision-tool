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

        Gate::define('manage-user-configuration', function ($user) use ($permissions) {
            return in_array('manage-user-configuration', $permissions);
        });

        Gate::define('manage-user', function ($user) use ($permissions) {
            return in_array('manage-user', $permissions);
        });

        Gate::define('manage-role', function ($user) use ($permissions) {
            return in_array('manage-role', $permissions);
        });

        Gate::define('manage-permission', function ($user) use ($permissions) {
            return in_array('manage-permission', $permissions);
        });

        Gate::define('manage-system-configuration', function ($user) use ($permissions) {
            return in_array('manage-system-configuration', $permissions);
        });
        Gate::define('set-activities-order', function ($user) use ($permissions) {
            return in_array('set-activities-order', $permissions);
        });

        Gate::define('manage-target-groups', function ($user) use ($permissions) {
            return in_array('manage-target-groups', $permissions);
        });

        Gate::define('manage-data-entry', function ($user) use ($permissions) {
            return in_array('manage-data-entry', $permissions);
        });

        Gate::define('view-stage-list', function ($user) use ($permissions) {
            return in_array('view-stage-list', $permissions);
        });

        Gate::define('manage-thematic-areas', function ($user) use ($permissions) {
            return in_array('manage-thematic-areas', $permissions);
        });

        Gate::define('manage-province', function ($user) use ($permissions) {
            return in_array('manage-province', $permissions);
        });

        Gate::define('manage-district', function ($user) use ($permissions) {
            return in_array('manage-district', $permissions);
        });

        Gate::define('manage-stage', function ($user) use ($permissions) {
            return in_array('manage-stage', $permissions);
        });

        Gate::define('manage-question', function ($user) use ($permissions) {
            return in_array('manage-question', $permissions);
        });

        Gate::define('manage-activities', function ($user) use ($permissions) {
            return in_array('manage-activities', $permissions);
        });

        Gate::define('manage-report', function ($user) use ($permissions) {
            return in_array('manage-report', $permissions);
        });
        Gate::define('manage-platforms', function ($user) use ($permissions) {
            return in_array('manage-platforms', $permissions);
        });

        Gate::define('can-map-activities', function ($user) use ($permissions) {
            return in_array('can-map-activities', $permissions);
        });
        Gate::define('add-activities-attributes-data', function ($user) use ($permissions) {
            return in_array('add-activities-attributes-data', $permissions);
        });
        Gate::define('add-activities-attributes', function ($user) use ($permissions) {
            return in_array('add-activities-attributes', $permissions);
        });

        Gate::define('ir-lead', function ($user) use ($permissions) {
            return in_array('ir-lead', $permissions);
        });
        Gate::define('ir1-mapping', function ($user) use ($permissions) {
            return in_array('ir1-mapping', $permissions);
        });

        Gate::define('ir2-mapping', function ($user) use ($permissions) {
            return in_array('ir2-mapping', $permissions);
        });

        Gate::define('ir3-mapping', function ($user) use ($permissions) {
            return in_array('ir3-mapping', $permissions);
        });

        Gate::define('ir4-mapping', function ($user) use ($permissions) {
            return in_array('ir4-mapping', $permissions);
        });
        Gate::define('program-managment', function ($user) use ($permissions) {
            return in_array('program-managment', $permissions);
        });
        Gate::define('finance-and-operation', function ($user) use ($permissions) {
            return in_array('finance-and-operation', $permissions);
        });
        Gate::define('gid-plan', function ($user) use ($permissions) {
            return in_array('gid-plan', $permissions);
        });
        Gate::define('merl-plan', function ($user) use ($permissions) {
            return in_array('merl-plan', $permissions);
        });
        Gate::define('eprr-plan', function ($user) use ($permissions) {
            return in_array('eprr-plan', $permissions);
        });
        Gate::define('diverse-partnerships', function ($user) use ($permissions) {
            return in_array('diverse-partnerships', $permissions);
        });
        Gate::define('sbcc-plan', function ($user) use ($permissions) {
            return in_array('sbcc-plan', $permissions);
        });
        Gate::define('add-federal-events-data', function ($user) use ($permissions) {
            return in_array('add-federal-events-data', $permissions);
        });
        Gate::define('add-province-events-data', function ($user) use ($permissions) {
            return in_array('add-province-events-data', $permissions);
        });
        Gate::define('add-districts-events-data', function ($user) use ($permissions) {
            return in_array('add-districts-events-data', $permissions);
        });

        return $next($request);
    }
}
