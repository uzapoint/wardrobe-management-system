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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('password_changed_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            //Ensure users remain in db even if deleted
            $table->softDeletes();

            //Indexes for users table
            $table->index(['name', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        //Drop indexes
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['name', 'email']);
        });

        Schema::dropIfExists('users');
    }
};
