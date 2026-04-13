<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $seller = User::factory()->create();
        $buyer = User::factory()->create();

        $item = Item::factory()->create([
            'user_id' => $seller->id,
            'price' => $this->faker->numberBetween(1000, 50000),
        ]);

        return [
            'item_id' => $item->id,
            'buyer_id' => $buyer->id,
            'seller_id' => $seller->id,
            'price' => $item->price,
            'payment_method' => $this->faker->randomElement([
                'カード払い',
                'コンビニ払い',
            ]),
            'postal_code' => $this->faker->numerify('###-####'),
            'address' => $this->faker->address(),
            'building' => $this->faker->optional()->secondaryAddress(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

