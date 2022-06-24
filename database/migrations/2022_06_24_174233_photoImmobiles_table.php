<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhotoImmobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_immobiles', function (Blueprint $table) {
            $table->increments('photo_immobiles_id');
            $table->string('photo_immobiles_name', 500)->nullable();
            $table->string('photo_immobiles_type', 250)->nullable();
            $table->string('photo_immobiles_url', 500)->nullable();
            $table->string('photo_immobiles_code_immobile', 20)->nullable();
            $table->char('photo_immobiles_principal', 2)->nullable();
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
        Schema::dropIfExists('photo_immobiles');
    }
}
