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
        Schema::create('drawers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wardrobe_id')->constrained('wardrobes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('drawer_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drawers');
    }
};
