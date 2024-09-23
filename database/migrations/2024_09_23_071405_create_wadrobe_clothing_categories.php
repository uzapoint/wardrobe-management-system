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
        Schema::create('wadrobe_clothing_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('wadrobe_id')->unsigned()->nullable();
            $table->string('description');
            $table->index('description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wadrobe_clothing_categories', function (Blueprint $table) {
            $table->dropIndex('description');
        });
        Schema::dropIfExists('wadrobe_clothing_categories');
    }
};
