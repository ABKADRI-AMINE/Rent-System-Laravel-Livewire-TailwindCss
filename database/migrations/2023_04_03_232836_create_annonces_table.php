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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('products_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('minday');
            $table->date('from');
            $table->date('to');
            $table->string('city');
            $table->decimal('regular_price',8,2);
            $table->decimal('sale_price',8,2)->nullable();
            $table->string('premium')->default('0');
            $table->integer('premium_duration')->default('0');
            $table->tinyInteger('stat')->default('1');
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
        Schema::dropIfExists('annonces');
    }
};
