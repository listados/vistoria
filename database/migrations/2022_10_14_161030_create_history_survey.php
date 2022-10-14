<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorySurvey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_survey', function (Blueprint $table) {
            $table->increments('history_survey_id');
            $table->string('history_survey_action',50)->nullable();
            $table->dateTime('history_survey_date')->nullable();
            $table->integer('history_survey_id_user')->unsigned();
            $table->foreign('history_survey_id_user')->references('id')->on('users');
            $table->integer('history_survey_id_survey')->unsigned();
            $table->foreign('history_survey_id_survey')->references('survey_id')->on('survey');
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
        Schema::dropIfExists('history_survey');
    }
}
