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
        Schema::create('case_portfolios', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');
            $table->string('file_path_1')->nullable();
            $table->string('file_path_2')->nullable();
            $table->string('file_path_3')->nullable();
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')
                ->references('id')->on('accounts')
                ->onDelete('cascade');
            $table->unsignedBigInteger('portfolio_id')->nullable();
            $table->foreign('portfolio_id')
                ->references('id')->on('portfolios')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_portfolios');
    }
};
