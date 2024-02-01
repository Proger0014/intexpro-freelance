<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'surname' => fake()->name(),
            'login' => fake()->unique()->email(),
            'password_hash' => static::$password ??= Hash::make('password'),
            'date_of_birth' => fake()->date(max: '2016-01-01'),
            'rating' => fake()->randomFloat(2, 0, 5)
        ];
    }
}
