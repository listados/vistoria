<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TeamSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teamSites', function (Blueprint $table) {
            $table->increments('teamSites_id');
            $table->string('teamSites_office' , 30)->nullable();
            $table->string('teamSites_name' , 30);
            $table->string('teamSites_phoneOne' , 25);
            $table->string('teamSites_phoneTwo' , 25)->nullable();
            $table->longText('teamSites_text')->nullable();
            $table->string('teamSites_linkedin', 50)->nullable(); 
            $table->string('teamSites_photo', 50); 
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
        Schema::dropIfExists('teamSites');
    }
}
