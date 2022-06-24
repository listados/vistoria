<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey', function (Blueprint $table) {
            $table->increments('survey_id');
            $table->date('survey_date');
            $table->string('survey_type')->nullable()->change();
            $table->string('survey_address_immobile')->nullable()->change();
            $table->string('survey_type_immobile')->nullable()->change();
            $table->string('survey_energy_meter')->nullable()->default('000')->change();
            $table->string('survey_energy_load')->nullable()->default('000')->change();
            $table->string('survey_water_meter')->nullable()->default('000')->change();
            $table->string('survey_water_load')->nullable()->default('000')->change();
            $table->string('survey_gas_meter')->nullable()->default('000')->change();
            $table->string('survey_gas_load')->nullable()->default('000')->change();
            $table->longText('survey_general_aspects');
            $table->longtext('survey_reservation');
            $table->string('survey_status');
            $table->timestamp('survey_finalized_date');
            $table->longtext('survey_keys');
            $table->string('survey_code');
            $table->string('survey_link_tour');
            $table->longtext('survey_provisions');
            $table->string('survey_date_register')->nullable()->default(Carbon::now())->change();
            $table->string('survey_inspetor_name')->nullable()->change();
            $table->string('survey_inspetor_cpf')->nullable()->change();
            $table->boolean('survey_filed')->default(0)->comment('Se a vistoria foi arquivada');
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
        Schema::dropIfExists('survey');
    }
}
