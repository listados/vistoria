<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropFieldsSurvey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('survey', function (Blueprint $table) {
            $table->dropColumn(['survey_locator_name', 'survey_locator_cpf', 'survey_locator_email' , 'survey_occupant_name' , 'survey_occupant_cpf' , 'survey_guarantor_name' , 'survey_guarantor_cpf' , 'survey_guarantor_email' , 'survey_occupant_email']);
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
