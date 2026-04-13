<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'image_path' => 'items/sample.jpg',
            'condition' => $this->faker->numberBetween(1, 5),
            'name' => $this->faker->words(3, true),
            'brand' => $this->faker->optional()->company(),
            'description' => $this->faker->sentence(20),
            'price' => $this->faker->numberBetween(1, 10000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
