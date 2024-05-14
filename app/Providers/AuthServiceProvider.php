<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

        // You can register policies here. But If you follow the rules of Laravel standard naming convension, you don't need to register policies here.
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define gates for authentication instructors to use the schedule class feature
        Gate::define('schedule-class', function (User $user) {
            return $user->role === 'instructor';
        });

        Gate::define('book-class', function (User $user) {
            return $user->role === 'member';
        });
    }
}
