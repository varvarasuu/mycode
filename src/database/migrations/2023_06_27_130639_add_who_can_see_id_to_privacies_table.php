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
        Schema::table('privacies', function (Blueprint $table) {
            $table->unsignedBigInteger('who_can_see_id')->after('section_id');
            $table->foreign('who_can_see_id')
                ->references('id')->on('who_can_sees')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('privacies', function (Blueprint $table) {
            //
        });
    }
};
