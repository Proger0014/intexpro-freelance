<?php

namespace Database\Seeders\Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeederDefault extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory(2)->create();

        Role::all()->pluck('id')
            ->each(function (int $roleId) {
                $createdUser = User::factory(1)->create()->first();

                $createdUser->roles()->attach($roleId);
            });
    }
}
