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
        Schema::create('paid_servicies', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');//->references('id')->on('paid_catalogs')->onDelete('cascade');
            $table->string('title');
            $table->string('subtitle');
            $table->float('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paid_servicies');
    }
};
