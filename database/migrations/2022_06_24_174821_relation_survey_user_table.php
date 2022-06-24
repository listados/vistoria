<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationSurveyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_survey_user', function (Blueprint $table) {
            $table->increments('relation_survey_user_id');
            $table->integer('relation_survey_user_id_survey')->nullable();
            $table->integer('relation_survey_user_id_user')->nullable();
            $table->string('relation_survey_user_cpf' , 30)->nullable();
            $table->string('relation_survey_user_type' , 15)->nullable();
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
        Schema::dropIfExists('relation_survey_user');
    }
}
