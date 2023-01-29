<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProposalReference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proposal', function (Blueprint $table) {
            $table->string('proposal_type_immobile', 25)->nullable();
            $table->string('proposal_name_immobile', 150)->nullable();
            $table->string('proposal_cnpj_cpf', 30)->nullable();
            $table->string('proposal_creci', 25)->nullable();
            $table->string('proposal_phone_immobile', 25)->nullable();
            $table->string('proposal_phone_mobile', 25)->nullable();
            $table->string('proposal_name_immobile2', 25)->nullable();
            $table->string('proposal_cnpj_cpf2', 25)->nullable();
            $table->string('proposal_creci2', 25)->nullable();
            $table->string('proposal_phone_immobile2', 25)->nullable();
            //inicio comercial
            $table->string('proposal_commercial_name', 25)->nullable();
            $table->string('proposal_commercial_cpf', 25)->nullable();
            $table->string('proposal_commercial_relation', 25)->nullable();
            $table->string('proposal_commercial_fixed_phone', 25)->nullable();
            $table->string('proposal_commercial_phone', 25)->nullable();
            $table->string('proposal_commercial_email', 25)->nullable();
            $table->string('proposal_commercial_name2', 25)->nullable();
            $table->string('proposal_commercial_cpf2', 25)->nullable();
            $table->string('proposal_commercial_relation2', 25)->nullable();
            $table->string('proposal_commercial_fixed_phone2', 25)->nullable();
            $table->string('proposal_commercial_phone2', 25)->nullable();
            $table->string('proposal_commercial_email2', 25)->nullable();
            //fim comercial
            //INICIO PESSOAL
            $table->string('proposal_person_name1', 25)->nullable();
            $table->string('proposal_person_cpf1', 25)->nullable();
            $table->string('proposal_person_relation1', 25)->nullable();
            $table->string('proposal_person_phone1', 25)->nullable();
            $table->string('proposal_person_email1', 25)->nullable();
            $table->string('proposal_person_name2', 25)->nullable();
            $table->string('proposal_person_cpf2', 25)->nullable();
            $table->string('proposal_person_relation2', 25)->nullable();
            $table->string('proposal_person_phone2', 25)->nullable();
            $table->string('proposal_person_email2', 25)->nullable();
            //FIM PESSOAL
            //INICIO BANCO
            $table->string('proposal_banking_current', 25)->nullable();
            $table->string('proposal_banking_name', 25)->nullable();
            $table->string('proposal_banking_agency', 25)->nullable();
            $table->string('proposal_banking_name_manager', 25)->nullable();
            $table->string('proposal_banking_name_phone', 25)->nullable();
            $table->string('proposal_banking_client_begin', 25)->nullable();
            $table->string('proposal_banking_origin_rent', 25)->nullable();
            $table->string('proposal_banking_card_credit', 25)->nullable();
            $table->string('proposal_banking_limit1', 25)->nullable();
            $table->string('proposal_banking_card_credit2', 25)->nullable();
            $table->string('proposal_banking_card_credit3', 25)->nullable();
            $table->string('proposal_banking_limit3', 25)->nullable();
            $table->string('proposal_banking_app', 25)->nullable();
            $table->string('proposal_banking_app_bank', 25)->nullable();
            $table->string('proposal_banking_app_agency', 25)->nullable();
            $table->string('proposal_banking_app_ref', 25)->nullable();
            $table->string('proposal_banking_app2', 25)->nullable();
            $table->string('proposal_banking_app_bank2', 25)->nullable();
            $table->string('proposal_banking_app_agency2', 25)->nullable();
            $table->string('proposal_banking_app_ref2', 25)->nullable();
            $table->string('proposal_banking_pre_aproved', 25)->nullable();
            //FIM BANCO
            //INICIO IMOVEIS
            $table->string('proposal_immobile_cep', 25)->nullable();
            $table->string('proposal_immobile_address', 25)->nullable();
            $table->string('proposal_immobile_address_number', 25)->nullable();
            $table->string('proposal_immobile_address_complement', 25)->nullable();
            $table->string('proposal_immobile_district', 25)->nullable();
            $table->string('proposal_immobile_city', 25)->nullable();
            $table->string('proposal_immobile_uf', 25)->nullable();
            $table->string('proposal_immobile_finance', 25)->nullable();
            $table->string('proposal_immobile_mat', 25)->nullable();            
            $table->string('proposal_immobile_car', 25)->nullable();
            $table->string('proposal_immobile_cep2', 25)->nullable();
            $table->string('proposal_immobile_address2', 25)->nullable();
            $table->string('proposal_immobile_address_number2', 25)->nullable();
            $table->string('proposal_immobile_address_complement2', 25)->nullable();
            $table->string('proposal_immobile_district2', 25)->nullable();
            $table->string('proposal_immobile_city2', 25)->nullable();
            $table->string('proposal_immobile_uf2', 25)->nullable();
            $table->string('proposal_immobile_finance2', 25)->nullable();
            $table->string('proposal_immobile_mat2', 25)->nullable();
            $table->string('proposal_immobile_car2', 25)->nullable();
            //FIM IMOVEIS
            //INICIO VEICULO
            $table->string('proposal_vehicle_mark', 25)->nullable();
            $table->string('proposal_vehicle_model', 25)->nullable();
            $table->string('proposal_vehicle_year', 25)->nullable();
            $table->string('proposal_vehicle_plaque', 25)->nullable();
            $table->string('proposal_vehicle_finance', 25)->nullable();
            $table->string('proposal_vehicle_financial', 25)->nullable();
            $table->string('proposal_vehicle_value', 25)->nullable();
            $table->string('proposal_vehicle_mark2', 25)->nullable();
            $table->string('proposal_vehicle_model2', 25)->nullable();
            $table->string('proposal_vehicle_year2', 25)->nullable();
            $table->string('proposal_vehicle_plaque2', 25)->nullable();
            $table->string('proposal_vehicle_finance2', 25)->nullable();
            $table->string('proposal_vehicle_financial2', 25)->nullable();
            $table->string('proposal_vehicle_value2', 25)->nullable();
            // FIM VEICULO
            //FIADOR
            $table->string('proposal_guarantor_cpf', 25)->nullable();
            $table->string('proposal_guarantor_name', 25)->nullable();
            $table->string('proposal_guarantor_relation', 25)->nullable();
            $table->string('proposal_guarantor_option', 25)->nullable();
            $table->string('guarantor_email', 25)->nullable();
            $table->string('proposal_guarantor_type', 25)->nullable();
            $table->string('proposal_guarantor_cpf2', 25)->nullable();
            $table->string('proposal_guarantor_name2', 25)->nullable();
            $table->string('proposal_guarantor_relation2', 25)->nullable();
            $table->string('proposal_guarantor_option2', 25)->nullable();
            $table->string('guarantor_email2', 25)->nullable();
            $table->string('proposal_guarantor_type2', 25)->nullable();
            //FIM FIADOR
            //INICIO OCUPANTE
            $table->string('proposal_occupant_cpf', 25)->nullable();
            $table->string('proposal_occupant_name', 25)->nullable();
            $table->string('proposal_occupant_option', 25)->nullable();
            $table->string('proposal_occupant_email', 25)->nullable();
            $table->string('proposal_occupant_cpf2', 25)->nullable();
            $table->string('proposal_occupant_name2', 25)->nullable();
            $table->string('proposal_occupant_option2', 25)->nullable();
            $table->string('proposal_occupant_email2', 25)->nullable();
            $table->string('proposal_occupant_relation', 25)->nullable();
            //FIM OCUPANTES
            $table->string('proposal_type', 25)->nullable();
            $table->string('proposal_status', 25)->nullable();
            $table->date('date_cadastre');
            $table->date('proposal_completed');
            $table->char('proposal_send');
            $table->integer('proposal_id_user');
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
