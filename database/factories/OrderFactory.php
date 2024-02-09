<?php

namespace Database\Factories;

use App\Models\OrdersCategory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usersId = Role::whereName('customer')->users()->pluck('id')->all();

        $categoriesId = OrdersCategory::pluck('id')->all();

        return [
            'title' => fake()->company(),
            'description' => fake()->company(),
            'user_id' => fake()->randomElement($usersId),
            'category_id' => fake()->randomElement($categoriesId),
            'expires_at' => fake()->dateTimeBetween('-1 years', 'now'),
            'result_is_link' => fake()->boolean()
        ];
    }
}
