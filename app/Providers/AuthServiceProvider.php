<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Exceptions\ErrorException;
use App\Policies\RolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        RolePolicy::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @throws ErrorException
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
