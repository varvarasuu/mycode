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
        Schema::create('list_of_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();

            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade');
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER create_list_of_employes_after_company_creation
            AFTER INSERT ON companies
            FOR EACH ROW
            BEGIN
                DECLARE done INT DEFAULT FALSE;
                DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

                INSERT INTO list_of_employees (company_id,created_at, updated_at)
                    VALUES (NEW.id, NOW(), NOW());
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS create_list_of_employes_after_company_creation');
        Schema::dropIfExists('list_of_employees');
    }
};
