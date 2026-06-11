<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
    public function boot(): void
    {
        Gate::before(function (User $user, $ability) {
            if ($user->hasRole('super-admin')) {
                return true;
            }
        });

        Gate::define('permission', function (User $user, string $permission) {
            return $user->hasPermission($permission);
        });

        Gate::define('role', function (User $user, string $role) {
            return $user->hasRole($role);
        });
    }
}
