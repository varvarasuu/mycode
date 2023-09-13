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
        Schema::create('default_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')
                ->references('id')->on('role_in_companies')
                ->onDelete('cascade');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('permission_id')
                ->references('id')->on('permission_in_companies')
                ->onDelete('cascade');
            $table->boolean('is_active')->default(0);
            $table->boolean('is_disabled')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_premissions');
    }
};
