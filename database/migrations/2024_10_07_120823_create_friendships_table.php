<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("friendships", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("initiator_user_id")
                ->comment("always acted friendship")
                ->index();
            $table->unsignedBigInteger("requested_user_id")
                ->comment("always accept or dismiss friendship")
                ->index();
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("friendships");
    }
};
