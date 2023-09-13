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
            $table->unsignedInteger('max_vacancies_direct_response')->nullable();
            $table->unsignedInteger('max_anon_vacancies')->nullable();
            $table->unsignedInteger('max_standard_vacancies')->nullable();
            $table->unsignedInteger('max_hot_vacancies')->nullable();
            $table->unsignedInteger('max_premium_vacancies')->nullable();
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
