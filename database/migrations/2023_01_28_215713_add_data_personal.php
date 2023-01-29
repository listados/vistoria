<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataPersonal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proposal', function (Blueprint $table) {
            $table->string('proposal_name')->nullable();
            $table->string('proposal_sex')->nullable();
            $table->date('proposal_date_brith')->nullable();
            $table->string('proposal_identity', 15)->nullable();
            $table->string('proposal_organ_issuing', 15)->default('SSP-CE')->nullable();
            $table->string('proposal_cpf', 35)->nullable();
            $table->string('proposal_nationality', 25)->nullable();
            $table->string('proposal_natural', 25)->nullable();
            $table->string('proposal_natural_uf', 30)->nullable();
            $table->string('proposal_estate_civil', 30)->nullable();
            $table->string('proposal_number_dependent', 10)->nullable();
            $table->string('proposal_degree_education', 35)->nullable();
            $table->string('proposal_filiation', 155)->nullable();
            $table->string('proposal_phone_fixed', 20)->nullable();
            $table->string('proposal_phone_cel1', 20)->nullable();
            $table->string('proposal_phone_cel2', 20)->nullable();
            $table->string('proposal_email', 150)->nullable();
            $table->string('proposal_cep', 30)->nullable();
            $table->string('proposal_address', 5)->nullable();
            $table->string('proposal_number', 30)->nullable();
            $table->string('proposal_complement', 50)->nullable();
            $table->string('proposal_district', 100)->nullable();
            $table->string('proposal_city', 50)->nullable();
            $table->string('proposal_state', 5)->nullable();
            $table->string('proposal_profission', 150)->nullable();
            $table->string('proposal_time_residing', 10)->nullable();
            $table->string('proposal_type_residence', 40)->nullable();
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
            $table->dropColumn('proposal_name');
            $table->dropColumn('proposal_sex');
            $table->dropColumn('proposal_date_brith');
            $table->dropColumn('proposal_identity');
            $table->dropColumn('proposal_organ_issuing');
            $table->dropColumn('proposal_cpf');
            $table->dropColumn('proposal_nationality');
            $table->dropColumn('proposal_natural');
            $table->dropColumn('proposal_natural_uf');
            $table->dropColumn('proposal_estate_civil');
            $table->dropColumn('proposal_number_dependent');
            $table->dropColumn('proposal_degree_education');
            $table->dropColumn('proposal_filiation');
            $table->dropColumn('proposal_phone_fixed');
            $table->dropColumn('proposal_phone_cel1');
            $table->dropColumn('proposal_phone_cel2');
            $table->dropColumn('proposal_email');
            $table->dropColumn('proposal_cep');
            $table->dropColumn('proposal_address');
            $table->dropColumn('proposal_number');
            $table->dropColumn('proposal_complement');
            $table->dropColumn('proposal_district');
            $table->dropColumn('proposal_city');
            $table->dropColumn('proposal_state');
            $table->dropColumn('proposal_profission');
            $table->dropColumn('proposal_time_residing');
            $table->dropColumn('proposal_type_residence');
        });
    }
}
