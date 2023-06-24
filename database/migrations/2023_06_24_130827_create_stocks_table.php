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
            $table->decimal('average_price', 8, 2);
            $table->decimal('ceiling_price', 8, 2)->nullable();
            $table->integer('quantity')->default(0);
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
