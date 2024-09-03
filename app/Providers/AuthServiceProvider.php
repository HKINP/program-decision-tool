<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Modules\Privilege\Models\Permission;
use Illuminate\Support\Facades\Session;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // dd(session()->get('access_permissions'));
        // Check if session data exists before defining gates
        if (Session::has('access_permissions')) {
            
            
            Gate::define('view-stage-list', function ($user) {
                return in_array('view-stage-list', session()->get('access_permissions'));
            });

            // Register permissions as gates
            // Permission::all()->each(function ($permission) {
            //     Gate::define($permission->name, function ($user) use ($permission) {
            //         return in_array($permission->name, session()->get('access_permissions'));
            //     });
            // });
        }
    }
}
