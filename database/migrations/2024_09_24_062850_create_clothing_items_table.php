<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Migration for the clothing_items table
    public function up(): void
    {
        Schema::create('clothing_items', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('name');
            $table->string('image');
            $table->string('size');
            $table->string('color');
            $table->string('material');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');  // Foreign key to 'categories'
            $table->foreignId('user_id')->constrained()->onDelete('cascade');      // Foreign key to 'users'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clothing_items');
    }
};
