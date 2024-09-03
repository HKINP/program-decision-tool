<?php

namespace App\Providers;

// use App\Actions\Fortify\CreateNewUser;
// use App\Actions\Fortify\ResetUserPassword;
// use App\Actions\Fortify\UpdateUserPassword;
// use App\Actions\Fortify\UpdateUserProfileInformation;

use App\Repositories\LogRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Event;
use Modules\Privilege\Repositories\UserRepository;

class FortifyServiceProvider extends ServiceProvider
{

    protected $logs;
    protected $users;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(
        LogRepository $logs,
        UserRepository $users
    ): void {
        // Assign repositories to class properties
        $this->logs = $logs;
        $this->users = $users;
        
        // Fortify::createUsersUsing(CreateNewUser::class);
        // Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        // Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        // Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Event::listen(Authenticated::class, function ($event) {
            $user = $this->users->with(['roles'])->where('id', '=', $event->user->id)->get()->first();
            $this->afterLogin($user);
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
    protected function afterLogin($user)
    {
        $permissions = collect();
        $roles = collect();
        // Fetch the user's roles and permissions
        foreach ($user->roles as $role) {
            $permissions = $permissions->merge($role->permissions);
            $roles->push($role->id);
        }

        // Flatten and filter unique permissions
        $access_permissions = $permissions->flatten(1)->pluck('guard_name')->unique()->toArray();
        // Store permissions and roles in session
        session()->put('access_permissions', $access_permissions);
        session()->put('roles', $roles->toArray());
        return true;
    }
}
