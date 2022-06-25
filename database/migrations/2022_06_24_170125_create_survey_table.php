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
            $table->date('survey_date')->default(Carbon::now());
            $table->longText('survey_general_aspects')->nullable();
            $table->longtext('survey_reservation')->nullable();
            $table->string('survey_status')->default('Rascunho');
            $table->timestamp('survey_finalized_date');
            $table->longtext('survey_keys')->nullable();
            $table->string('survey_code')->nullable();
            $table->string('survey_link_tour')->nullable();
            $table->longtext('survey_provisions')->nullable();
            $table->boolean('survey_filed')->default(0)->comment('Se a vistoria foi arquivada');
            $table->string('survey_type')->nullable();
            $table->string('survey_address_immobile')->nullable();
            $table->string('survey_type_immobile')->nullable();
            $table->string('survey_energy_meter')->nullable()->default('---');
            $table->string('survey_energy_load')->nullable()->default('---');
            $table->string('survey_water_meter')->nullable()->default('---');
            $table->string('survey_water_load')->nullable()->default('---');
            $table->string('survey_gas_meter')->nullable()->default('---');
            $table->string('survey_gas_load')->nullable()->default('---');
            $table->timestamp('survey_date_register')->nullable();
            $table->string('survey_inspetor_name')->nullable();
            $table->string('survey_inspetor_cpf')->nullable();
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
