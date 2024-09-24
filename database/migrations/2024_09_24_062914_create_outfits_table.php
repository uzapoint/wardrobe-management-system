<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Migration for outfits table
    public function up(): void
    {
        Schema::create('outfits', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('name');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key to 'users'
            $table->timestamps();
        });

        Schema::create('clothing_item_outfit', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->foreignId('clothing_item_id')->constrained()->onDelete('cascade');  // Foreign key to 'clothing_items'
            $table->foreignId('outfit_id')->constrained()->onDelete('cascade');         // Foreign key to 'outfits'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outfits');
    }
};
