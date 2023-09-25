<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $startTime = now()->addMinutes(2)->toDateTimeString();
        // Set the start time of the event to 5 minutes from now
        DB::unprepared("
        CREATE EVENT `update_state_event_test`
        ON SCHEDULE EVERY 1 minute
        STARTS '$startTime'
        ON COMPLETION NOT PRESERVE ENABLE
        DO
        UPDATE demandes SET state='done' WHERE reservation_Fdate <= CURDATE() and state='Accepted';
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP EVENT IF EXISTS `update_started_demande_test`');
    }
};
