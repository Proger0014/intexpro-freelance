<?php

namespace App\Providers;

use App\Abstractions\OrderCategoryService;
use App\Abstractions\OrderService;
use App\Abstractions\RoleService;
use App\Abstractions\UserService;
use App\Http\Auth\Gates\GatesRegister;
use App\Services\OrderCategoryServiceImpl;
use App\Services\OrderServiceImpl;
use App\Services\RoleServiceImpl;
use App\Services\UserServiceImpl;
use Illuminate\Support\Facades\Schema;
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
        $this->app->singleton(OrderCategoryService::class, OrderCategoryServiceImpl::class);
        $this->app->singleton(OrderService::class, OrderServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Для mysql 8 версии, где utf8mb4 означает максимальную длину 125 символов в гибридном индексе
        Schema::defaultStringLength(125);
    }
}
