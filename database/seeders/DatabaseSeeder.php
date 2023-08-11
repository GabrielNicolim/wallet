<?php

namespace Database\Seeders;

use App\Models\Sector;
use App\Models\Stock;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Teste',
            'email' => 'teste@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('qwe123'),
        ]);

        Wallet::factory()->create([
            'name' => 'Carteira - 2023',
        ]);

        Sector::factory()->create([
            'name' => 'Materiais básicos',
            'user_id' => 1
        ]);

        $stocks = ['VALE3', 'PETR4', 'BBAS3'];

        foreach($stocks as $stock) {
            Stock::factory()->create([
                'name' => $stock,
            ]);
        }
    }
}
