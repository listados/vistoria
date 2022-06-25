<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FilesAmbienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_ambience', function (Blueprint $table) {
            $table->increments('files_ambience_id');
            $table->string('files_ambience_description_file', 150)->nullable();
            $table->string('files_ambience_type', 20)->nullable();
            $table->integer('files_ambience_id_ambience')->nullable();
            $table->integer('files_ambience_id_survey')->nullable();
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
        Schema::dropIfExists('files_ambience');
    }
}
