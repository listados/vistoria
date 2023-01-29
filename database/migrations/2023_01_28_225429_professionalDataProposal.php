<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfessionalDataProposal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proposal', function (Blueprint $table) {
            $table->string('proposal_business')->nullable();
            $table->string('proposal_cnpj', 30)->nullable();
            $table->string('proposal_clt', 130)->nullable();
            $table->date('proposal_admission_date')->nullable();
            $table->string('proposal_phone_rh', 20)->nullable();
            $table->string('proposal_contact_person', 25)->nullable();
            $table->string('proposal_branch', 5)->nullable();
            $table->string('proposal_email_business', 150)->nullable();
            $table->float('proposal_salary', 10,2)->nullable();
            $table->float('proposal_rent_other', 10,2)->nullable();
            $table->string('proposal_origin_other_rent')->nullable();
            $table->string('proposal_cep_business', 25)->nullable();
            $table->string('proposal_number_business', 10)->nullable();
            $table->string('proposal_address_business', 50)->nullable();
            $table->string('proposal_complement_business', 20)->nullable();
            $table->string('proposal_district_business', 150)->nullable();
            $table->string('proposal_city_business', 150)->nullable();
            $table->string('proposal_uf_business', 30)->nullable();
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
        $table->dropColumn('proposal_business');
            $table->dropColumn('proposal_cnpj');
            $table->dropColumn('proposal_clt');
            $table->dropColumn('proposal_admission_date');
            $table->dropColumn('proposal_phone_rh');
            $table->dropColumn('proposal_contact_person');
            $table->dropColumn('proposal_branch');
            $table->dropColumn('proposal_email_business');
            $table->dropColumn('proposal_salary');
            $table->dropColumn('proposal_rent_other');
            $table->dropColumn('proposal_origin_other_rent');
            $table->dropColumn('proposal_cep_business');
            $table->dropColumn('proposal_number_business');
            $table->dropColumn('proposal_address_business');
            $table->dropColumn('proposal_complement_business');
            $table->dropColumn('proposal_district_business');
            $table->dropColumn('proposal_city_business');
            $table->dropColumn('proposal_uf_business');
        });
    }
}
