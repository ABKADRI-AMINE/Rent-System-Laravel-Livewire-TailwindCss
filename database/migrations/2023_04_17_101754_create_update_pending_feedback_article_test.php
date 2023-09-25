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
        $startTime = now()->addMinutes(2)->toDateTimeString();
        // Set the start time of the event to 5 minutes from now

        DB::unprepared("CREATE DEFINER='root'@'localhost' EVENT `update_pending_feedback_article_test` ON SCHEDULE EVERY 1 hour STARTS '$startTime' ON COMPLETION NOT PRESERVE ENABLE DO update demandes set feedbackArticle='done' where state='done' AND TIMESTAMPDIFF(week, updated_at, NOW()) > 1;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP EVENT IF EXISTS `update_pending_feedback_article_test`');
    }
};
