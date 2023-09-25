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
        Schema::create('feedback_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('nb_stars');
            $table->string('comment');
            $table->enum('status', [0, 1])->default(0); // ajouter la colonne statut contenant une énumération de 0 ou 1
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
        Schema::dropIfExists('feedback_clients');
    }
};
