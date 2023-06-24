<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'average_price' => fake()->randomNumber(2, 2),
            'ceiling_price' => fake()->randomNumber(2, 2),
            'quantity' => fake()->randomNumber(3),
            'wallet_id' => 1,
            'sector_id' => 1,
        ];
    }
}
