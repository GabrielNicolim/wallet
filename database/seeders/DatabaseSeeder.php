<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Teste',
            'email' => 'teste@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('qwe123'),
        ]);

        \App\Models\Wallet::factory()->create([
            'name' => 'Carteira - 2023',
        ]);

        \App\Models\Sector::factory()->create([
            'name' => 'Materiais básicos'
        ]);

        $stocks = ['VALE3', 'PETR4', 'BBAS3'];

        foreach($stocks as $stock) {
            \App\Models\Stock::factory()->create([
                'name' => $stock,
            ]);
        }
    }
}
