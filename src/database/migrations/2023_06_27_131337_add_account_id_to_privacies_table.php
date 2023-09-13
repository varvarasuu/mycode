<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('privacies', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->after('who_can_see_id');
            $table->foreign('account_id')
                ->references('id')->on('accounts')
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
