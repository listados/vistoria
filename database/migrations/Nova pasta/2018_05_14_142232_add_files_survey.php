<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilesSurvey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*PARA AS VISTORIAS NÃO SER EXCLUIDAS*/
        Schema::table('survey', function (Blueprint $table) {
            $table->boolean('survey_filed')->default(0)->comment('Se a vistoria foi arquivada');
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
