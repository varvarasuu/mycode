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
        Schema::create('phone_codes', function (Blueprint $table) {
            $table->id();
            $table->integer('code');

            $table->integer('is_active')->nullable();
            $table->string('ip')->nullable();
            $table->string('phone_number');
            $table->string('type');
            $table->boolean('is_expired')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_codes');
    }
};
