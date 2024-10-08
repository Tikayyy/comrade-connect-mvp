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
        Schema::create('user_has_servers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("server_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("status");
            $table->unsignedBigInteger("role");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_has_servers');
    }
};
