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
        Schema::create('used_promos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id');
            $table->foreignId('promo_id');
            $table->integer('times_promo_used');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('used_promos');
    }
};
