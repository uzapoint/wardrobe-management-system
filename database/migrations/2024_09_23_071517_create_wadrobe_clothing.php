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
        Schema::create('wadrobe_clothing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wadrobe_id')->constrained()->cascadeOnDelete();
            $table->string('description');
            $table->foreignId('wadrobe_clothing_category_id')->constrained()->cascadeOnDelete();
            $table->index('description'); // Index
            $table->softDeletes(); //backup measure
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('wadrobes_clothing', function (Blueprint $table) {
            $table->dropIndex('description');
        });
        Schema::dropIfExists('wadrobe_clothing');
    }
};
