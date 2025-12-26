<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->unique(); // e.g., 'BTCUSD', 'EURUSD'
            $table->string('name'); // e.g., 'Bitcoin', 'Euro / US Dollar'
            $table->decimal('price', 15, 5)->default(0); // High precision for forex/crypto
            $table->decimal('change_24h', 10, 2)->default(0); // Percentage change
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
