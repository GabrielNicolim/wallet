<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'ceiling_price' => fake()->randomNumber(2, 2),
            'wallet_id' => 1,
            'sector_id' => 1,
        ];
    }
}
