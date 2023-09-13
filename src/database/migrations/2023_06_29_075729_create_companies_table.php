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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('type_short')->nullable();
            $table->string('type_full')->nullable();
            $table->string('name')->nullable();
            $table->string('name_full')->nullable();
            $table->string('inn')->unique();;
            $table->string('kpp')->nullable();
            $table->string('ogrn')->nullable();
            $table->string('ogrn_date')->nullable();
            $table->string('okved')->nullable();
            $table->string('okved_text')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_position')->nullable();
            $table->string('okato')->nullable();
            $table->string('oktmo')->nullable();
            $table->string('okfs')->nullable();
            $table->string('okogu')->nullable();
            $table->string('okpo')->nullable();
            $table->string('type_capital')->nullable();
            $table->string('sum_capital')->nullable();
            $table->string('status')->nullable();
            $table->string('status_text')->nullable();
            $table->text('tax_inspection')->nullable();
            $table->text('address')->nullable();
            $table->text('short_description')->nullable();
            $table->text('website')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('cover_image_id')->nullable();
            $table->unsignedBigInteger('logo_image_id')->nullable();

            $table->foreign('cover_image_id')
                ->references('id')->on('media_files')
                ->onDelete('set null');

            $table->foreign('logo_image_id')
                ->references('id')->on('media_files')
                ->onDelete('set null');

            $table->unsignedBigInteger('company_size_id')->nullable();
            $table->foreign('company_size_id')
                ->references('id')->on('company_sizes')
                ->onDelete('cascade');

            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')
                ->references('id')->on('regions')
                ->onDelete('cascade');

            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')
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
        Schema::dropIfExists('companies');
    }
};
