<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamSitesTable extends Migration
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
            $table->string('teamSites_office' , 30);
            $table->string('teamSites_name' , 30);
            $table->string('teamSites_phoneOne' , 25);
            $table->string('teamSites_phoneTwo' , 25);
            $table->longText('teamSites_text');
            $table->string('teamSites_linkedin', 50); 
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
        Schema::dropIfExists('sites');
    }
}
