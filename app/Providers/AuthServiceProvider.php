<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Exceptions\ErrorException;
use App\Http\Auth\Gates\GatesRegister;
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
     *
     * @throws ErrorException
     */
    public function boot(GatesRegister $gatesRegister): void
    {
        if ($this->app->runningInConsole()) return;

        $this->registerPolicies();

        $gatesRegister->defineGatesForRole();
    }
}
