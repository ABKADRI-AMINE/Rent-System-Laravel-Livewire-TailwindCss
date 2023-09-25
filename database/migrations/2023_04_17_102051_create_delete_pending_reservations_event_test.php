 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the stored procedure
        DB::unprepared('
        CREATE PROCEDURE delete_pending_reservations_proc()
        BEGIN
            UPDATE annonces SET stat = 1 WHERE id IN (
                SELECT annonce_id FROM demandes
                WHERE state = \'pending\' AND TIMESTAMPDIFF(hour, created_at, NOW()) > 24
            );
            DELETE FROM demandes WHERE state = \'pending\' AND TIMESTAMPDIFF(hour, created_at, NOW()) > 24;
        END
        ');

        // Set the start time of the event to 5 minutes from now
        $startTime = now()->addMinutes(5)->toDateTimeString();

        // Create the event that calls the stored procedure
        DB::unprepared("CREATE DEFINER='root'@'localhost' EVENT `delete_pending_reservations_event_test` ON SCHEDULE EVERY 1 hour STARTS '$startTime' ON COMPLETION NOT PRESERVE ENABLE DO CALL delete_pending_reservations_proc();");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP EVENT IF EXISTS `delete_pending_reservations_event_test`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `delete_pending_reservations_proc`');
    }
};
