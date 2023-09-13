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
        Schema::table('detail_list_of_employees', function (Blueprint $table) {
            $table->string('position')->nullable();
            $table->unsignedBigInteger('prof_level_id')->default(1);
            $table->foreign('prof_level_id')
                ->references('id')->on('professional_levels')
                ->onDelete('cascade');
            $table->string('extra_contacts')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_list_of_employees', function (Blueprint $table) {
            //
        });
    }
};
