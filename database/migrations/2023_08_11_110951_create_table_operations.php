<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->tinyInteger('type');
            $table->timestamps();
            $table->foreignId('stock_id')->constrained('stocks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
