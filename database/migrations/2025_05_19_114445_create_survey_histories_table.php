<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('survey_histories', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('survey_id'); // id da vistoria alterada
            $table->unsignedInteger('user_id');   // usuário que fez a alteração
            
            $table->string('field');      // campo alterado
            $table->text('old_value')->nullable(); // valor anterior (pode ser texto longo)
            $table->text('new_value')->nullable(); // valor novo
            
            $table->timestamp('changed_at'); // data e hora da alteração
            
            $table->timestamps();

            // Foreign keys
            $table->foreign('survey_id')->references('survey_id')->on('survey')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('survey_histories');
    }
}
