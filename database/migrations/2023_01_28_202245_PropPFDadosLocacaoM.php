<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PropPFDadosLocacaoM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proposal', function (Blueprint $table) {
            $table->string('proposal_reference')->nullable();
            $table->string('proposal_finality',50)->nullable();
            $table->string('proposal_time_contract',15)->nullable();
            $table->string('proposal_type_guarantee',30)->nullable();
            $table->float('proposal_rent_proposed',10,2)->nullable();
            $table->float('proposal_value_condominium',10,2)->nullable();
            $table->float('proposal_value_iptu',10,2)->nullable();
            $table->string('proposal_lease_reason',150)->nullable();
            $table->string('proposal_ps')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposal', function (Blueprint $table) {
            //
        });
    }
}
