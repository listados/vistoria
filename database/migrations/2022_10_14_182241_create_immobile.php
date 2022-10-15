<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmobile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immobiles', function (Blueprint $table) {
            $table->increments('immobiles_id');
            $table->string('immobiles_cep',20)->nullable();
            $table->string('immobiles_address',150)->nullable();
            $table->string('immobiles_number',10)->nullable();
            $table->string('immobiles_complement',50)->nullable();
            $table->string('immobiles_district',50)->nullable();
            $table->string('immobiles_city',50)->nullable();
            $table->string('immobiles_state',50)->nullable();
            $table->string('immobiles_reference_point',50)->nullable();
            $table->string('immobiles_code',50)->nullable();
            $table->string('immobiles_status',50)->nullable();
            $table->timestamp('immobiles_date_register')->nullable();
            $table->timestamp('immobiles_date_update')->nullable();
            $table->string('immobiles_property_title',50)->nullable();
            $table->char('immobiles_publish',1)->nullable();
            $table->string('immobiles_name_condo',50)->nullable();
            $table->string('immobiles_business_status',50)->nullable();
            $table->integer('immobiles_type_offer')->nullable();
            $table->float('immobiles_selling_price',8,2)->nullable();
            $table->string('immobiles_type_rental',50)->nullable();
            $table->float('immobiles_rental_price',8,2)->nullable();
            $table->char('immobiles_rental_warranty',1)->nullable();
            $table->string('immobiles_board_on_site',50)->nullable();
            $table->string('immobiles_useful_area',50)->nullable();
            $table->string('immobiles_total_area',50)->nullable();
            $table->string('immobiles_metrica_unit',50)->nullable();
            $table->string('immobiles_property_default',50)->nullable();
            $table->string('immobiles_property_localization',50)->nullable();
            $table->string('immobiles_ocupacion',50)->nullable();
            $table->string('immobiles_accept_negotiation',50)->nullable();
            $table->string('immobiles_face_immobile',50)->nullable();
            $table->string('immobiles_qtd_dormitory',50)->nullable();
            $table->string('immobiles_qtd_suite',50)->nullable();
            $table->string('immobiles_qtd_toilet',50)->nullable();
            $table->string('immobiles_qtd_uncovered_jobs',50)->nullable();
            $table->longtext('immobiles_ps')->nullable();
            $table->string('immobiles_finality',50)->nullable();
            $table->string('immobiles_latitude',50)->nullable();
            $table->string('immobiles_longitude',50)->nullable();
            $table->float('immobiles_iptu_price',8,2)->nullable();
            $table->float('immobiles_condominium_price',8,2)->nullable();
            $table->string('immobiles_type_immobiles',50)->nullable();
            $table->char('immobiles_type_publication',1)->nullable();
            $table->string('immobiles_tour_virtual',250)->nullable();
            $table->float('immobiles_price_season',8,2)->nullable();
            $table->string('immobiles_face',25)->nullable();
            $table->char('immobiles_electronic_door',1)->nullable();
            $table->char('immobiles_front_sea',1)->nullable();
            $table->char('immobiles_sea_shore',1)->nullable();
            $table->char('immobiles_wine_house',1)->nullable();
            $table->integer('immobiles_elevator')->nullable();
            $table->char('immobiles_barbecue_grill',1)->nullable();
            $table->char('immobiles_poll',1)->nullable();
            $table->char('immobiles_sports_court',1)->nullable();
            $table->char('immobiles_soccer_field',1)->nullable();
            $table->char('immobiles_furnished',1)->nullable();
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
        Schema::dropIfExists('immobiles');
    }
}
