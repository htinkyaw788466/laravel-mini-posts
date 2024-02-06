<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('post-edit',function($user,$post){
             return $user->id==$post->user_id;
        });

        Gate::define('post-delete',function($user,$post){
            return $user->id==$post->user_id;
        });

        Gate::define('comment-delete',function($user,$comment){
            return $user->id==$comment->user_id;
        });
    }
}
