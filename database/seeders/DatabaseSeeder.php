<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::factory(2)->create();

        User::factory(rand(5, 25))->create()
            ->each(function (User $user) {
            Role::all()->take(rand(1, 2))->pluck('id')
                ->each(function (int $role) use ($user) {
                    $user->roles()->attach($role);
                });
        });
    }
}
