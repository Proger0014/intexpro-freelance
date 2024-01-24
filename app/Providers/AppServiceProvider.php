<?php

namespace App\Providers;

use App\Abstractions\RoleService;
use App\Abstractions\UserService;
use App\Services\RoleServiceImpl;
use App\Services\UserServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserService::class, UserServiceImpl::class);
        $this->app->singleton(RoleService::class, RoleServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
