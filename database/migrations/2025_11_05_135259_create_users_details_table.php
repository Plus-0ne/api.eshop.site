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
        Schema::create('users_details', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->collation('utf8mb4_bin')->unique();

            $table->string('user_uuid')->collation('utf8mb4_bin')->unique();

            $table->string('first_name')->nullable();

            $table->string('last_name')->nullable();

            $table->string('middle_name')->nullable();

            $table->string('display_name')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_details');
    }
};
