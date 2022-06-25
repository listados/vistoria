<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderAmbienceSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_ambience_survey', function (Blueprint $table) {
            $table->increments('order_ambience_survey_id');
            $table->integer('order_ambience_survey_id_survey')->nullable();
            $table->string('order_ambience_survey_list_order', 255)->nullable();
            $table->char('order_ambience_survey_order', 1)->nullable();
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
        Schema::dropIfExists('order_ambience_survey');
    }
}
