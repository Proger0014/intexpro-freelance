<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrdersCategory;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseProductionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $createdRoles = $this->createRoles();

        $createdPermissions = $this->createPermissions();

        collect($createdRoles)->each(function (Role $role) use ($createdPermissions) {
            $permissions = collect($createdPermissions[$role->name])->values()->all();

            $role->syncPermissions($permissions);
        });

        $roles = [ 'executor', 'customer' ];

        collect($roles)->each(function (string $roleName) {
            $role = Role::whereName($roleName)->first();
            $user = User::factory()->create([ 'login' => $roleName ])->where('login', $roleName)->first();

            $user->assignRole($role);
        });

        $this->createCategories();

        Order::factory(rand(25, 60))->create();
    }

    private function createCategories(): void {
        $categories = ['web-dev', 'programming', 'design', 'study-activities', 'content'];

        collect($categories)->each(fn (string $category) =>
        OrdersCategory::create([
            'name' => $category
        ]));
    }

    /**
     * @return array<Role>
     */
    private function createRoles(): array {
        $roles = ['executor', 'customer' ];

        return collect($roles)->map(fn (string $roleName) =>
            Role::create([ 'name' => $roleName ]))->all();
    }

    /**
     * @return array<string, array<string, Permission>>
     */
    private function createPermissions(): array {
        $permissionsList = [
            'executor' => [
                'role.read',
                'user.read',
                'user.update.self',
                'order.read',
                'order-request.create',
                'order-request.read',
            ],

            'customer' => [
                'order.read',
                'order.own-created.*',
                'role.read',
                'user.*',
                'role.assign-to-user.executor'
            ],
        ];

        return collect($permissionsList)->reduce(function (array $store, array $permissions, string $role) {
            collect($permissions)->each(function (string $permission) use (&$store, $role) {
                $exists = $this->existsPermissions($permission, $store);

                if ($exists) {
                    if (!Arr::exists($store, $role)) {
                        $store[$role] = [];
                    }

                    array_push($store[$role], $store[$exists]);
                } else {
                    if (!Arr::exists($store, $role)) {
                        $store[$role] = [];
                    }

                    Permission::create(['name' => $permission]);

                    array_push($store[$role], $permission);
                }
            });

            return $store;
        }, array());
    }

    /**
     * @param string $targetPermission
     * @param array<string, array<string>> $array
     *
     * @return string|null возвращает ключ, где находит нужный permissions, либо null, если отсутсвует
     */
    private function existsPermissions(string $targetPermission, array $array): ?string {
        if (empty($array)) return null;

        foreach ($array as $roleName => $permissions) {
            if (in_array($targetPermission, $permissions)) return $roleName;
        }

        return null;
    }
}
