<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('evaluations_id');
            $table->integer('evaluations_id_key')->unsigned();
            $table->string('evaluations_visited',50)->nullable();
            $table->string('evaluations_interested',50)->nullable();
            $table->string('evaluations_value_immobile',50)->nullable();
            $table->string('evaluations_conservation',50)->nullable();
            $table->string('evaluations_location',50)->nullable();
            $table->longText('evaluations_feedback')->nullable();
            $table->string('evaluations_name_friend',50)->nullable();
            $table->string('evaluations_phone_friend',50)->nullable();
            $table->string('evaluations_email_friend',50)->nullable();          
            $table->foreign('evaluations_id_key')->references('keys_id')->on('keys');
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
        Schema::dropIfExists('evaluations');
    }
}
