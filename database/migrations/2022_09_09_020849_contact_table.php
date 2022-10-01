<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phoneFixed', 15)->nullable();
            $table->string('phoneMobile', 15)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('district', 150)->nullable();
            $table->string('city', 150)->nullable();
            $table->string('state', 150)->nullable();
            $table->string('cep', 15)->nullable();
            $table->string('creci', 15)->nullable();
            $table->string('cnpj', 15)->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
