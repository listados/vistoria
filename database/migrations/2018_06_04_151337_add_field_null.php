<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class AddFieldNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('survey', function (Blueprint $table) {
             $table->string('survey_inspetor_name')->nullable()->change();
             $table->string('survey_inspetor_cpf')->nullable()->change();
             $table->string('survey_type')->nullable()->change();
             $table->string('survey_address_immobile')->nullable()->change();
             $table->string('survey_type_immobile')->nullable()->change();

              $table->string('survey_energy_meter')->nullable()->default('000')->change();
             $table->string('survey_energy_load')->nullable()->default('000')->change();
             $table->string('survey_water_meter')->nullable()->default('000')->change();
             $table->string('survey_water_load')->nullable()->default('000')->change();
             $table->string('survey_gas_meter')->nullable()->default('000')->change();
             $table->string('survey_gas_load')->nullable()->default('000')->change();
             $table->string('survey_date_register')->nullable()->default(Carbon::now())->change();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey', function (Blueprint $table) {
            //
        });
    }
}
