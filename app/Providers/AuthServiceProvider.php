<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Article;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerGates();
    }

    public function registerGates()
    {
        Gate::define('is_admin', function ($user) {
            return $user->group_id == ROLE_ADMIN;
        });

        Gate::define('is_reviewer', function ($user) {
            return $user->group_id == ROLE_REVIEWER;
        });

        Gate::define('is_user', function ($user) {
            return $user->group_id == ROLE_USER;
        });

        Gate::define('can_preview', function ($user, Article $article) {
            return $article->created_by == $user->id 
                || $article->review_by == $user->id
                || $user->group_id == ROLE_ADMIN;
        });
    }
}
