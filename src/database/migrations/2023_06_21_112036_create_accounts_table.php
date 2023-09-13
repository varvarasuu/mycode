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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('phone_number');
            $table->integer('is_active')->nullable();
            $table->unsignedBigInteger('employer_status_id')->nullable();
            $table->unsignedBigInteger('applicant_status_id')->nullable();

            $table->foreign('employer_status_id')
                ->references('id')->on('general_statuses')
                ->onDelete('set null');

            $table->foreign('applicant_status_id')
                ->references('id')->on('general_statuses')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
