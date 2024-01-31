<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Support\Arr;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $createdRoles = $this->createRoles();

        $createdPermissions = $this->createPermissions();

        collect($createdRoles)->where(fn (Role $role) => $role->name != 'admin')
            ->each(function (Role $role) use ($createdPermissions) {
            $permissions = collect($createdPermissions[$role->name])->values()->all();

            $role->syncPermissions($permissions);
        });

        User::factory(rand(5, 25))->create()->each(function (User $user) use ($createdRoles) {
            $randomRoleForUser = Arr::random([ 'executor', 'customer', 'admin'], 1);

            collect($createdRoles)
                ->filter(fn (Role $role) => in_array($role->name, $randomRoleForUser))
                ->each(function (Role $role) use ($user) {
                    $user->assignRole($role);
                });
        });
    }

    /**
     * @return array<Role>
     */
    private function createRoles(): array {
        $roles = ['executor', 'customer', 'admin'];

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
                'user.update.self'
            ],

            'customer' => [
                'role.read',
                'user.*',
                'role.assign-to-user.customer'
            ],
        ];

        return collect($permissionsList)->reduce(function (array $store, array $permissions, string $role) {
            collect($permissions)->each(function (string $permission) use (&$store, $role) {
                $exists = $this->existsPermissions($permission, $store);

                if ($exists) {
                    if (!Arr::exists($store, $role)) {
                        $store[$role] = [];
                    }

                    $store[$role] += $store[$exists];
                } else {
                    if (!Arr::exists($store, $role)) {
                        $store[$role] = [];
                    }

                    $createdPermission = Permission::create(['name' => $permission]);

                    $store[$role] += [$permission => $createdPermission];
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
            if (Arr::exists($permissions, $targetPermission)) return $roleName;
        }

        return null;
    }
}
