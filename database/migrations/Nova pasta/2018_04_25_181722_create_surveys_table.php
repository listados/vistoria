<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('survey_id');
            $table->date('survey_date');
            $table->string('survey_type');
            $table->string('survey_address_immobile');
            $table->string('survey_type_immobile');
            $table->string('survey_energy_meter');
            $table->string('survey_energy_load');
            $table->string('survey_water_meter');
            $table->string('survey_water_load');
            $table->string('survey_gas_meter');
            $table->longText('survey_general_aspects');
            $table->longtext('survey_reservation');
            $table->string('survey_status');
            $table->timestamp('survey_finalized_date');
            $table->longtext('survey_keys');
            $table->string('survey_code');
            $table->string('survey_link_tour');
            $table->longtext('survey_provisions');
            $table->date('survey_date_register');
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
        Schema::dropIfExists('surveys');
    }
}
