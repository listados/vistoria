<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelivery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('deliveries_name', 50)->nullable($value = false);
            $table->string('deliveries_phone', 30)->nullable();
            $table->string('deliveries_mobile', 30)->nullable();
            $table->float('deliveries_value', 8,2)->nullable();
            $table->string('deliveries_cpf', 30)->nullable();
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
        Schema::dropIfExists('deliveries');
    }
}
