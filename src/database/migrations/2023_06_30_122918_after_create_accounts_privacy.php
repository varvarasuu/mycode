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
        DB::unprepared('
            CREATE TRIGGER create_privacy_after_account_creation
            AFTER INSERT ON accounts
            FOR EACH ROW
            BEGIN
                DECLARE sectionId INT;
                DECLARE done INT DEFAULT FALSE;
                DECLARE cur CURSOR FOR SELECT id FROM sections;
                DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

                OPEN cur;
                read_loop: LOOP
                    FETCH cur INTO sectionId;
                    IF done THEN
                        LEAVE read_loop;
                    END IF;

                    INSERT INTO privacies (section_id, account_id, who_can_see_id, created_at, updated_at)
                    VALUES (sectionId, NEW.id, 1, NOW(), NOW());
                END LOOP;

                CLOSE cur;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS create_privacy_after_account_creation');
    }
};
