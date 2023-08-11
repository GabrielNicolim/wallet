<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('ceiling_price', 8, 2)->nullable();
            $table->timestamps();
            $table->foreignId('wallet_id')->constrained('wallets');
            $table->foreignId('sector_id')->constrained('sectors');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
