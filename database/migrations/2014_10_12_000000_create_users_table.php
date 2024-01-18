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
            $table->string('fisrt_name');
            $table->string('last_name');
            $table->string('surname');
            $table->string('login')->unique();
            $table->string('password_hash');
            $table->date('date_of_birth');
            $table->timestamp('added_at');
            $table->timestamp('updated_at')->nullable();
            $table->decimal('rating', 5, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
