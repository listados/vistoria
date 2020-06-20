<div class="row">
    <div class="col-md-12">
        <label class="text-info" style="font-size: 12pt; ">Dados da Locação - Atendente responsável:  <span>{{ $name_atendent }}</span></label>
        <label> | &rsaquo;  P.Nº : <?php echo $proposta[0]['proposal_id']; ?></label>
        <div class="bottom_div"></div>
        <table class="tg">
            <tr>
                <td class="tg-0lax"><strong>Endereço ou código do Imóvel: </strong> <span>{{ ($proposta[0]['proposal_reference'])}}</span></td>
                <td class="tg-0lax"><strong>Tipo do Imóvel:</strong> <span>{{ ($proposta[0]['proposal_type_immobile'])}}</span></td>
            </tr>
            <tr>
                <td class="tg-0lax"> <strong>Finalidade: </strong> <span>{{ ($proposta[0]['proposal_finality'])}}</span></td>
                <td class="tg-0lax"><strong>Prazo do contrato:</strong> <span>{{ ($proposta[0]['proposal_time_contract'])}}</span></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Tipo de garantia: </strong> <span>{{ ($proposta[0]['proposal_type_guarantee'])}}</span></td>
                <td class="tg-0lax"> <strong>Aluguel Proposto:</strong> <span>{{ number_format($proposta[0]['proposal_rent_proposed'],2,',','.')}}</span></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Condomínio: </strong> <span>{{ ($proposta[0]['proposal_value_condominium'])}}</span></td>
                <td class="tg-0lax"><strong>IPTU - Mensal:</strong> <span{{ number_format($proposta[0]['proposal_value_iptu'],2,',','.')}}></span></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Motivo da Locação: </strong> <span>{{ ($proposta[0]['proposal_lease_reason'])}}</span></td>
            </tr>
            <tr>
                <td><strong>Observação:</strong> <span>{{ ($proposta[0]['proposal_ps'])}}</span></td>
            </tr>
        </table>

    </div>
    @if($titulo_proposta == 'Análise Cadastral (PF)')
        <br>
        <div>
            <table width="100%" style="margin: 10px;">
                <tr class="tr_color">
                    <td width="50%">
                        <label for=""> <strong> Aluguel e Encargos: </strong> <?php 
                            $total_encargos= (  $proposta[0]['proposal_value_condominium'] + 
                                                    $proposta[0]['proposal_rent_proposed'] + 
                                                    $proposta[0]['proposal_value_iptu'] );
                            echo 'R$ '.number_format($total_encargos, 2, ',', '.');
                             ?>   </label>
                    </td>
                    <td>
                        <label> <strong>Renda mínima desejada: </strong>R$ 
                        <?php $total_desejado = ($total_encargos * 3);
                            echo number_format($total_desejado, 2, ',', '.'); ?></label>
                    </td>
                </tr>
            </table>
        </div>
    @endif
    <div class="col-md-12">
        <label class="text-info" style="font-size: 12pt;">Dados Pessoais Proponente</label>                        
        <div class="bottom_div"></div>
        <table class="tg">
            <tr>
                <td class="tg-0lax"><strong>Nome Completo: </strong> <span>{{ $proposta[0]['proposal_name'] }}</span></td>
                <td class="tg-0lax"><strong>Sexo:</strong> <span><?php ($proposta[0]['proposal_sex']); ?></span></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Data nascimento: </strong> <span>{{ date('d/m/Y' , strtotime($proposta[0]['proposal_date_brith']))  }}</span></td>
                <td class="tg-0lax"><strong>Identidade:</strong> <span>{{ $proposta[0]['proposal_identity'] }}</span><br /></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Órgão expeditor:</strong> <span>{{ ($proposta[0]['proposal_organ_issuing'])  }}</span></td>
                <td class="tg-0lax"><strong>CPF:</strong> <span>{{ ($proposta[0]['proposal_cpf'])}}</span></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Nacionalidade: </strong> <span>{{   $proposta[0]['proposal_nationality']  }}</span></td>
                <td class="tg-0lax"><strong>Naturalidade:</strong> <span>{{ $proposta[0]['proposal_natural'] }}</span></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>UF: </strong> <span>{{ ($proposta[0]['proposal_natural_uf'])  }}</span></td>
                <td class="tg-0lax"><strong>Estado civil:</strong> <span>{{ $proposta[0]['proposal_estate_civil'] }}</span><br /></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Nº de dependentes:</strong> <span>{{ ($proposta[0]['proposal_number_dependent'])  }}</span></td>
                <td class="tg-0lax"><strong>Filiação:</strong> <span>{{ $proposta[0]['proposal_filiation'] }}</span><br /></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Grau de Instrução:</strong> <span>{{ $proposta[0]['proposal_degree_education'] }}</span><br /></td>
                <td class="tg-0lax"><strong>Telefone:</strong> <span>{{ ($proposta[0]['proposal_phone_fixed'])  }}</span></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Celular: </strong> <span>{{ $proposta[0]['proposal_phone_cel1'] }}</span><br /></td>
                <td class="tg-0lax"><strong>Celular:</strong> <span>{{ ($proposta[0]['proposal_phone_cel2'])  }}</span></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>E-Mail:</strong> <span>{{ $proposta[0]['proposal_email'] }}</span><br /></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Endereço:</strong> <span>{{ $proposta[0]['proposal_address'] }}</span><br /></td>
                <td class="tg-0lax"><strong>Número:</strong> <span>{{ ($proposta[0]['proposal_number'])  }}</span></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Complemento:</strong> <span>{{ $proposta[0]['proposal_complement'] }}</span><br /></td>
                <td class="tg-0lax"><strong>Bairro:</strong> <span>{{ ($proposta[0]['proposal_district'])   }}</span></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>Cidade:</strong> <span>{{ $proposta[0]['proposal_city'] }}</span><br /></td>
            </tr>
            <tr>
                <td class="tg-0lax"><strong>CEP:</strong> <span>{{ ($proposta[0]['proposal_cep'])  }}</span></td>
                <td class="tg-0lax"><strong>Tempo que reside:</strong> <span>{{ ($proposta[0]['proposal_time_residing'])  }}</span></td>
            </tr>
            <tr>
                <td class="tg-0lax"> <strong>Tipo de Residência:</strong> <span>{{ $proposta[0]['proposal_type_residence'] }}</span><br /></td>
            </tr>
        </table>
    </div>

    <div class="col-md-12">
        <label class="text-info" style="font-size: 12pt;">Dados profissionais</label>                        
        <div class="bottom_div"></div>
        <?php
            $campos = array('proposal_business','proposal_cnpj','proposal_clt','proposal_profission','proposal_email_business');
                    //$info_prof =  verifica_campos($proposta,$campos);
                    //if($info_prof == true){
                        //echo "<h4>Nada Informado</h4>"; 
                   // }else{       
            ?>                      
        <table style="width:100%;">
            <tr>
                <td><strong>Profissão: </strong> <span><?php echo ($proposta[0]['proposal_profission']); ?></span></td>
                <td><strong>Atividade: </strong> <span><?php  echo ($proposta[0]['proposal_activity']); ?></span></td>
            </tr>
            <tr>
                <td><strong>Empresa: </strong> <span><?php  echo ($proposta[0]['proposal_business']); ?></span></td>
                <td><strong>CNPJ: </strong> <span><?php echo  ($proposta[0]['proposal_cnpj']); ?></span></td>
            </tr>
            <tr>
                <td><strong>Vínculo Empregatício: </strong> <span><?php echo  ($proposta[0]['proposal_clt']); ?></span></td>
                <td><strong>Data de admissão: </strong> <span><?php echo ($proposta[0]['proposal_admission_date']); ?></span></td>
            </tr>
            <tr>
                <td> <strong>Cargo/Função: </strong> <span><?php echo  ($proposta[0]['proposal_function']); ?></span></td>
                <td><strong>Pessoa para contato: </strong> <span><?php  echo ($proposta[0]['proposal_contact_person']); ?></span></td>
            </tr>
            <tr>
                <td><strong>Telefone(RH): </strong> <span><?php echo  ($proposta[0]['proposal_phone_rh']); ?></span></td>
                <td><strong>Ramal: </strong> <span><?php  echo ($proposta[0]['proposal_branch']);?></span></td>
            </tr>
            <tr>
                <td><strong>E-mail (RH): </strong> <span><?php echo  ($proposta[0]['proposal_email_business']); ?></span></td>
                <td><strong>Salário(R$): </strong> <span><?php echo  ($proposta[0]['proposal_salary']);?></span></td>
            </tr>
            <tr>
                <td><strong>Outras Rendas(R$):</strong> <span><?php echo  ($proposta[0]['proposal_rent_other']); ?></span></td>
                <td><strong>Origem outras rendas:</strong> <span><?php echo  ($proposta[0]['proposal_origin_other_rent']); ?></span></td>
            </tr>
            <tr>
                <td><strong>Endereço: </strong> <span><?php echo  ($proposta[0]['proposal_address_business']); ?></span></td>
                <td><strong>Número: </strong> <span><?php echo  ($proposta[0]['proposal_number_business']); ?></span></td>
            </tr>
            <tr>
                <td><strong>Complemento: </strong> <span><?php echo  ($proposta[0]['proposal_complement_business']); ?></span></td>
                <td><strong>Bairro: </strong> <span><?php echo  ($proposta[0]['proposal_district_business']);?></span></td>
            </tr>
            <tr>
                <td><strong>Cidade: </strong> <span><?php echo  ($proposta[0]['proposal_city_business']); ?></span></td>
                <td><strong>UF: </strong> <span><?php echo  ($proposta[0]['proposal_uf_business']);
                    ?></span></td>
            </tr>
            <tr>
                <td><strong>CEP: </strong> <span><?php echo  ($proposta[0]['proposal_cep_business']); ?></span></td>
            </tr>
            <tr>
                <td>
                <td><br></td>
                <td><br></td>
                </td>
            </tr>
        </table>
        <?php //}//fim IF ?>  
    </div>
    
    <!--CONSULTANDO SE TEM CONJUGE-->
    @if(!empty($proposta[0]['proposal_conjuge_name']))
        <div class="col-md-12">
            <label class="text-info" style="font-size: 12pt;">Dados do cônjuge</label>                        
            <div class="bottom_div"></div>
             
            <table style="width:100%;">
                <tr>
                    <td style="width: 50%;">
                        <strong>Nome Completo: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_name']);  ?></span>
                    </td>
                    <td>
                        <strong>CPF: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_cpf']);  ?></span>
                    </td>
                </tr>
                <tr>
                    <td><strong>Sexo: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_sex']);  ?></span></td>
                    <td><strong>Data nascimento: </strong> <span><?php echo  ($proposta[0]['proposal_conjuge_date_brith']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Identidade: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_identity']); ?></span></td>
                    <td><strong>Órgão expedidor: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_organ_issuing']);  ?></span></td>
                </tr>
                <tr>
                    <td><strong>Nacionalidade: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_nationality']);  ?></span></td>
                    <td><strong>Grau de Instrução: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_degree_education']);  ?></span></td>
                </tr>
                <tr>
                    <td><strong>Naturalidade: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_natural']); ?></span></td>
                    <td><strong>UF: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_uf']);  ?></span></td>
                </tr>
                <tr>
                    <td><strong>Telefone: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_phone_fixed']); ?></span></td>
                    <td><strong>Celular: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_phone_cel1']);  ?></span></td>
                </tr>
                <tr>
                    <td><strong>Celular: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_phone_cel2']);  ?></span></td>
                    <td><strong>E-Mail: </strong> <span><?php echo ($proposta[0]['proposal_conjuge_email']);  ?></span></td>
                </tr>
            </table>
           
            
        </div>
    @endif
    <div class="col-md-12">
        <div class="row" style="border:1px solid black; padding: 2px;">
            <label class="text-info" style="font-size: 12pt; ">Referências</label>  
            <br />            
        </div>
        @if(!empty($proposta[0]['proposal_name_immobile']) || !empty($proposta[0]['proposal_cnpj_cpf']) || !empty($proposta[0]['proposal_name_immobile2']) || !empty($proposta[0]['proposal_cnpj_cpf2']))
            <label class="text-info">Imobiliárias</label>
            <div class="bottom_div"></div>
           
            <table style="width:100%;">
                <tr style="">
                    <td style="width: 50%;">
                        <strong>Nome: </strong> <span><?php echo ($proposta[0]['proposal_name_immobile']); ?></span>
                    </td>
                    <td><strong>CPF / CNPJ: </strong> <span><?php echo ($proposta[0]['proposal_cnpj_cpf']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>CRECI: </strong> <span><?php echo ($proposta[0]['proposal_creci']); ?></span></td>
                    <td><strong>Telefone: </strong> <span><?php echo ($proposta[0]['proposal_phone_immobile']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Celular: </strong> <span><?php echo ($proposta[0]['proposal_phone_mobile']); ?></span></td>
                    <td><strong>E-mail: </strong> <span><?php echo ($proposta[0]['proposal_email_immobile']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Nome: </strong> <span><?php echo ($proposta[0]['proposal_name_immobile2']); ?></span></td>
                    <td><strong>CPF / CNPJ: </strong> <span><?php echo ($proposta[0]['proposal_cnpj_cpf2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>CRECI: </strong> <span><?php echo ($proposta[0]['proposal_creci2']); ?></span></td>
                    <td><strong>Telefone: </strong> <span><?php echo ($proposta[0]['proposal_phone_immobile2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Celular: </strong> <span><?php echo ($proposta[0]['proposal_phone_mobile2']); ?></span></td>
                    <td><strong>E-mail: </strong> <span><?php echo ($proposta[0]['proposal_email_immobile2']); ?></span></td>
                </tr>
            </table>
            <br />         
            <?php //}//fim IF ?> 
        @else
            <label class="text-info">Imobiliárias</label>
             <div class="bottom_div"></div>
            <h5>{{ "Nada Informado" }}</h5>
        @endif
    </div> 

    <div class="col-md-12">
        <label class="text-info">Comerciais</label>
        <div class="bottom_div"></div>
        @if(!empty($proposta[0]['proposal_commercial_name']) || !empty($proposta[0]['proposal_commercial_cpf2']) || !empty($proposta[0]['proposal_commercial_name2']) || !empty($proposta[0]['proposal_commercial_cpf']))
            <table style="width:100%;">
                <tr style="">
                    <td style="width: 50%;">
                        <strong>(1) Nome:</strong> <span><?php echo ($proposta[0]['proposal_commercial_name']); ?></span>
                    </td>
                    <td><strong>CNPJ:</strong> <span><?php echo ($proposta[0]['proposal_commercial_cpf2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Telefone:</strong> <span><?php echo ($proposta[0]['proposal_commercial_fixed_phone']); ?></span></td>
                    <td><strong>Celular:</strong> <span><?php echo ($proposta[0]['proposal_commercial_phone2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>E-mail:</strong> <span><?php echo ($proposta[0]['proposal_commercial_email']); ?></span></td>
                    <td><strong>(2) Nome:</strong> <span><?php echo ($proposta[0]['proposal_commercial_name2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>CNPJ:</strong> <span><?php echo ($proposta[0]['proposal_commercial_cpf']); ?></span></td>
                    <td><strong>Telefone:</strong> <span><?php echo ($proposta[0]['proposal_commercial_fixed_phone2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Celular:</strong> <span><?php echo ($proposta[0]['proposal_commercial_phone']); ?></span></td>
                    <td><strong>E-mail:</strong> <span><?php echo ($proposta[0]['proposal_commercial_email2']); ?></span></td>
                </tr>
        </table>
        @else
            <h5>{{ "Nada Informado" }}</h5>
        @endif
       
    </div> 

    <div class="col-md-12">
        <label  class="text-info">Pessoais</label>
        <div class="bottom_div"></div>
       
         @if(!empty($proposta[0]['proposal_person_name1']) || !empty($proposta[0]['proposal_person_name2']) )
            <table style="width:100%;">
                <tr style="">
                    <td style="width: 50%;">
                        <strong>(1) Nome: </strong> <span><?php echo ($proposta[0]['proposal_person_name1']); ?></span></span>
                    </td>
                    <td><strong>CPF: </strong> <span><?php echo ($proposta[0]['proposal_person_cpf1']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Qual a relação: </strong> <span><?php echo ($proposta[0]['proposal_person_relation1']); ?></span></td>
                    <td><strong>Telefone: </strong> <span><?php echo ($proposta[0]['proposal_person_phone_fixed1']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>E-mail: </strong> <span><?php echo ($proposta[0]['proposal_person_email1']); ?></span></td>
                    <td><strong>(2) Nome: </strong> <span><?php echo ($proposta[0]['proposal_commercial_name2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Celular: </strong> <span><?php echo ($proposta[0]['proposal_person_phone1']); ?></span></td>
                    <td><strong>Telefone: </strong> <span><?php echo ($proposta[0]['proposal_commercial_fixed_phone2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>(2) Nome: </strong> <span><?php echo ($proposta[0]['proposal_person_name2']); ?></span></td>
                    <td><strong>CPF: </strong> <span><?php echo ($proposta[0]['proposal_person_cpf2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Qual a relação: </strong> <span><?php echo ($proposta[0]['proposal_person_relation2']); ?></span></td>
                    <td><strong>Telefone: </strong> <span><?php echo ($proposta[0]['proposal_person_phone_fixed2']); ?></span></span></td>
                </tr>
                <tr>
                    <td><strong>E-mail: </strong> <span><?php echo ($proposta[0]['proposal_person_email2']); ?></span></td>
                    <td><strong>Celular: </strong> <span><?php echo ($proposta[0]['proposal_person_phone2']); ?></span></td>
                </tr>
            </table>
        @else
            <h5>{{ "Nada Informado" }}</h5>
        @endif
                       
    </div>  

    <div class="col-md-12">
        <label class="text-info">Bancárias</label>
        <div class="bottom_div"></div>
         @if(!empty($proposta[0]['proposal_banking_current']) || !empty($proposta[0]['proposal_banking_agency'])  || !empty($proposta[0]['proposal_banking_card_credit'])  || !empty($proposta[0]['proposal_banking_name']))
        <table style="width:100%;">
            <tr style="">
                <td style="width: 50%;">
                    <strong>Conta Corrente:</strong> <span><?php echo ($proposta[0]['proposal_banking_current']); ?></span>
                </td>
                <td><strong>Banco:</strong> <span><?php echo ($proposta[0]['proposal_banking_name']); ?></span></td>
            </tr>
            <tr>
                <td><strong>Agência:</strong> <span><?php echo ($proposta[0]['proposal_banking_agency']); ?></span></td>
                <td><strong>Telefone:</strong> <span><?php echo ($proposta[0]['proposal_banking_name_phone']); ?></span></td>
            </tr>
            <tr>
                <td><strong>Nome Gerente: </strong> <span><?php echo ($proposta[0]['proposal_banking_name_manager']); ?></span></td>
                <td><strong>Cliente desde: </strong> <span><?php echo  ($proposta[0]['proposal_banking_client_begin']); ?></span></td>
            </tr>
            <tr>
                <td><strong>E-mail: </strong> <span><?php echo ($proposta[0]['proposal_banking_email']); ?></span></td>
                <td><strong>Crédito pré-aprovado: </strong> <span><?php echo ($proposta[0]['proposal_person_email2']); ?></span></td>
               
            </tr>
            <tr>
                <td><strong>Cartão de Crédito: </strong> <span><?php echo ($proposta[0]['proposal_banking_card_credit']); ?></span></td>
                <td><strong>Limite: </strong> <span><?php echo number_format($proposta[0]['proposal_banking_limit1'], 2 , ',' , '.');   ?></span></td>
            </tr>
            <tr>
                <td><strong>Cartão de Crédito: </strong> <span><?php echo ($proposta[0]['proposal_banking_card_credit2']); ?></span></td>                
                <td><strong>Limite: </strong> <span><?php echo number_format($proposta[0]['proposal_banking_limit2'], 2 , ',' , '.');  ?></span></td>
            </tr>
        </table>
        <div class="col-md-12">
            <table style="width:100%;">
                <tr style="">
                    <td style="width: 50%;">
                        <strong>1 - Poupança / Aplicações (R$):</strong> <span><?php echo ($proposta[0]['proposal_banking_app']); ?></span>
                    </td>
                    <td><strong>2 - Poupança / Aplicações (R$):</strong> <span><?php echo ($proposta[0]['proposal_banking_app2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Banco:</strong> <span><?php echo ($proposta[0]['proposal_banking_app_bank']); ?></span></td>
                    <td><strong>Banco:</strong> <span><?php echo ($proposta[0]['proposal_banking_app_bank2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Agência: </strong> <span><?php echo ($proposta[0]['proposal_banking_app_agency']); ?></span></td>
                    <td><strong>Agência:</strong> <span><?php echo ($proposta[0]['proposal_banking_app_agency2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Conta. (nº):</strong> <span><?php echo ($proposta[0]['proposal_banking_app_ref']); ?></span></td>
                    <td><strong>Conta. (nº):</strong> <span><?php echo ($proposta[0]['proposal_banking_app_ref2']); ?></span></td>
                </tr>
            </table>
            <br />       
        </div>
     @else
        <h5>{{ "Nada Informado" }}</h5>
    @endif         
    </div>
   
   
    
        <div class="col-md-12">
            <div class="row" style="border:1px solid black; padding: 2px;">
                <label class="text-info">BENS</label>
            </div>
            <label class="text-info">Imóveis</label>
            <div class="bottom_div"></div>
             @if(!empty($proposta[0]['proposal_immobile_cep']) || !empty($proposta[0]['proposal_immobile_address'])  || !empty($proposta[0]['proposal_immobile_cep2'])  || !empty($proposta[0]['proposal_immobile_address2']))
                <table style="width:100%;">
                    <tr style="">
                        <td style="width: 50%;">
                            <strong>CEP: </strong> <span><?php echo ($proposta[0]['proposal_immobile_cep']); ?></span></span>
                        </td>
                        <td><strong>Endereço: </strong> <span><?php echo ($proposta[0]['proposal_immobile_address']); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Número: </strong> <span><?php echo ($proposta[0]['proposal_immobile_address_number']); ?></span></td>
                        <td><strong>Complemento: </strong> <span><?php echo ($proposta[0]['proposal_immobile_address_complement']); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Bairro: </strong> <span><?php echo ($proposta[0]['proposal_immobile_district']); ?></span></td>
                        <td><strong>Cidade: </strong> <span><?php echo ($proposta[0]['proposal_immobile_city']); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>UF: </strong> <span><?php echo ($proposta[0]['proposal_immobile_uf']); ?></span></td>
                        <td><strong>Valor: </strong> <span><?php echo ($proposta[0]['proposal_immobile_value']); ?></span></td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            <strong>Financiado: </strong> <span><?php echo ($proposta[0]['proposal_immobile_finance']); ?></span>
                        </td>
                        <td><strong>Matrícula: </strong> <span><?php echo ($proposta[0]['proposal_immobile_mat']); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Cartório: </strong> <span><?php echo ($proposta[0]['proposal_immobile_car']); ?></span></td>
                        <td><strong>CEP: </strong> <span><?php echo ($proposta[0]['proposal_immobile_cep2']); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Endereço: </strong> <span><?php echo ($proposta[0]['proposal_immobile_address2']); ?></span></td>
                        <td><strong>Número: </strong> <span><?php echo ($proposta[0]['proposal_immobile_address_number2']); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Complemento: </strong> <span><?php echo ($proposta[0]['proposal_immobile_address_complement2']); ?></span></td>
                        <td><strong>Bairro: </strong> <span><?php echo ($proposta[0]['proposal_immobile_district2']); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Cidade: </strong> <span><?php echo ($proposta[0]['proposal_immobile_city2']); ?></span></td>
                        <td><strong>UF: </strong> <span><?php echo ($proposta[0]['proposal_immobile_uf2']); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Valor: </strong> <span><?php echo ($proposta[0]['proposal_immobile_value2']); ?></span></td>
                        <td><strong>Financiado: </strong> <span><?php echo ($proposta[0]['proposal_immobile_finance2']); ?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Matrícula: </strong> <span><?php echo ($proposta[0]['proposal_immobile_mat2']); ?></span></td>
                        <td><strong>Cartório: </strong> <span><?php echo ($proposta[0]['proposal_immobile_car2']); ?></span></td>
                    </tr>
                </table>
            <br />           
            @else
                <h5>{{ "Nada Informado" }}</h5>
            @endif
        </div>

        <div class="col-md-12">
            <label class="text-info">Veículos</label>
            <div class="bottom_div"></div>
            @if(!empty($proposta[0]['proposal_vehicle_mark']) || !empty($proposta[0]['proposal_vehicle_model'])  || !empty($proposta[0]['proposal_vehicle_mark2'])  || !empty($proposta[0]['proposal_vehicle_model2']))
            <table style="width:100%;">
                <tr>
                    <td style="width: 50%;">
                        <strong>Marca:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_mark']); ?></span>
                    </td>
                    <td><strong>Modelo:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_model']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Ano:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_year']); ?></span></td>
                    <td><strong>Placa:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_plaque']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Financiado:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_finance']); ?></span></td>
                    <td><strong>Financeira:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_financial']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Valor:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_value']); ?></span></td>
                    <td><strong>Marca:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_mark2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Modelo:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_model2']); ?></span></td>
                    <td><strong>Ano:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_year2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Placa:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_plaque2']); ?></span></td>
                    <td><strong>Financiado:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_finance2']); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Financeira:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_financial2']); ?></span></td>
                    <td><strong>Valor:</strong> <span><?php echo ($proposta[0]['proposal_vehicle_value2']); ?></span></td>
                </tr>
            </table>
            <br />           
            @else
                <h5>{{ "Nada Informado" }}</h5>
            @endif                      
        </div>

        <div class="col-md-12">
            <label class="text-info">(01) Fiador</label>
            <div class="bottom_div"></div>
            <?php
               // $campos = array('proposal_guarantor_name','guarantor_email');
                     
                ?>
            <table style="width:100%;">
                <tr>
                    <td>
                        <strong>Tipo:</strong> <span><?php echo $proposta[0]['proposal_guarantor_cpf']; ?></span>
                    </td>
                    <td><strong>Nome:</strong> <span><?php echo $proposta[0]['proposal_guarantor_name']; ?></span></td>
                </tr>
                <tr>
                    <td><strong>Relação entre fiador e proponente:</strong> <span><?php echo $proposta[0]['proposal_guarantor_relation']; ?></span></td>
                    <td><strong>E-mail:</strong> <span><?php echo $proposta[0]['guarantor_email']; ?></span></td>
                </tr>
                <tr>
                    <td><strong>Obs.:</strong> <span><?php if($proposta[0]['proposal_guarantor_type'] == "cadastrar_fiador"){echo "Optou por cadastrar o Fiador";}else{echo "Optou enviar para o Fiador";} ?></span></td>
                    <td></td>
                </tr>
            </table>
            <br />              
               
        </div>

        <div class="col-md-12">
            <label class="text-info">(02) Fiador</label>
            <div class="bottom_div"></div>
            <?php
                //$campos = array('proposal_guarantor_name2','guarantor_email2');               
            ?>
            <table style="width:100%;">
                <tr>
                    <td>
                        <strong>Tipo:</strong> <span><?php echo $proposta[0]['proposal_guarantor_cpf2']; ?></span>
                    </td>
                    <td><strong>Nome:</strong> <span><?php echo $proposta[0]['proposal_guarantor_name2']; ?></span></td>
                </tr>
                <tr>
                    <td><strong>Relação entre fiador e proponente:</strong> <span><?php echo $proposta[0]['proposal_guarantor_relation2']; ?></span></td>
                    <td><strong>E-mail:</strong> <span><?php echo $proposta[0]['guarantor_email2']; ?></span></td>
                </tr>
                <tr>
                    <td><strong>Obs.:</strong> <span><?php if($proposta[0]['proposal_guarantor_type2'] == "cadastrar_fiador"){echo "Optou por cadastrar o Fiador";}else{echo "Optou enviar para o Fiador";} ?></span></td>
                    <td></td>
                </tr>
            </table>
            <br />             
            <?php //}//fim IF ?>         
        </div>
</div>