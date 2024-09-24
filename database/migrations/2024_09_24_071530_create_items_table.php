<?php

use App\Models\User;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->restrictOnDelete();
            $table->string("name");
            $table->enum("category", ["shirt", "trouser", "jacket", "shoes"]);
            $table->enum("size", ["xs", "s", "m", "l", "xl"]);
            $table->enum("color", ["red", "blue", "black", "white"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
