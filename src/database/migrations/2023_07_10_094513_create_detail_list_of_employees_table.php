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
        Schema::create('detail_list_of_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('list_of_employees_id');
            $table->foreign('list_of_employees_id')
                ->references('id')->on('list_of_employees')
                ->onDelete('cascade');

            $table->unsignedBigInteger('role_in_company_id');
            $table->foreign('role_in_company_id')
                ->references('id')->on('role_in_companies')
                ->onDelete('cascade');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')
                ->references('id')->on('accounts')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_list_of_employees');
    }
};
