<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Abstractions\RoleService;
use App\Exceptions\ErrorException;
use App\Http\Auth\Gates\GatesRegister;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function boot(RoleService $roleService, GatesRegister $gatesRegister): void
    {
        $rolesResult = $roleService->getAll();

        if ($rolesResult->isError()) {
            $error = $rolesResult->getError();

            throw new ErrorException(
                type: $error->type,
                title: $error->title,
                status: $error->status,
                detail: $error->detail
            );
        }
    }
}
