<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('annonce_particuliere', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('annonces_id');
            $table->foreign('annonces_id')->references('id')->on('annonces')->onDelete('cascade');
            $table->json('disponible_days');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonce_particuliere');
    }
};
