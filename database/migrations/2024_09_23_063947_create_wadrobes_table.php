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
        Schema::create('wadrobes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); //Foriegn id for users to wadrobe associaion
            $table->index('user_id'); //index
            $table->softDeletes(); //backup measure
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        //Remove indexes
        Schema::table('wadrobes', function (Blueprint $table) {
            $table->dropIndex('user_id');
        });
        Schema::dropIfExists('wadrobes');
    }
};
