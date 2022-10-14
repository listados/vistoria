<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->increments('keys_id');
            $table->string('evaluations_visited',50)->nullable();
            $table->string('keys_code',50)->nullable();
            $table->string('keys_cod_immobile',50)->nullable();
            $table->string('keys_status',50)->nullable();
            $table->string('keys_devolution',50)->nullable();
            $table->string('keys_type',50)->nullable();
            $table->longText('keys_ps')->nullable();
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
        Schema::dropIfExists('keys');
    }
}
