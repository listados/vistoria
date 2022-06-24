<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('settings');
            $table->string('nick', 50)->nullable();
            $table->string('settings_description', 150)->nullable();
            $table->integer('settings_id_user')->nullable();
            $table->integer('settings_id_profile')->nullable();
            $table->integer('settings_aspect_general_active')->nullable();
            $table->longText('settings_aspect_general')->nullable();
            $table->integer('settings_reservation_active')->nullable();
            $table->longText('settings_reservation')->nullable();
            $table->integer('settings_provisions_active')->nullable();
            $table->longText('settings_provisions')->nullable();
            $table->longText('settings_keys')->nullable();
            $table->integer('settings_keys_active')->nullable();
            $table->dateTime('settings_date_last_sync')->nullable();
            $table->integer('settings_total_immobile_sync')->nullable();
            $table->integer('settings_id_user_sync')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
