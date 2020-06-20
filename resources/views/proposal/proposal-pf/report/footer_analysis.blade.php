<div>
    <br/>
    <label class="text-info">PERGUNTAS ELIMINATÓRIAS</label>
    <div class="bottom_div"></div>
</div>
<div id="analise_cadastral">
    <table width="100%" >
        <tr class="tr_color">
            <td width="70%">
                a) Possuem registro no SPC?
            </td>
            <td width="30%" >(   )SIM  -  (   )NÃO </td>
        </tr>
        <tr>
            <td>Justifica, se houver:</td>
        </tr>
        <tr>
            <td width="70%" class="tr_color">
                a) Possuem processo judiciais que questionem sua idoneidade?
            </td>
            <td width="30%" class="tr_color">(   )SIM  -  (   )NÃO </td>
        </tr>
        <tr>
            <td>Justifica, se houver:</td>
        </tr>
        <tr>
            <td width="70%" class="tr_color">
                c) Possuem renda familiar líquida igual a 3 vezes o valor do aluguel?
            </td>
            <td width="30%" class="tr_color">(   )SIM  -  (   )NÃO </td>
        </tr>
        <tr>
            <td>Justifica, se houver:</td>
        </tr>
        <tr >
            <td colspan="2" class="tr_color">
                RESULTADO ELIMINATÓRIAS:    (   ) Aprovado  -  (   ) Aprovado com ressalvas  -  (   ) Reprovado 
            </td>
        </tr>
        <tr>
            <td>Observações, se houver:</td>
        </tr>
    </table>
    <!--PERGUNTAS CLASSIFICATÓRIAS -->
    <div class="text-center">
        <br/>
        <label class="text-info">PERGUNTAS CLASSIFICATÓRIAS</label>
        <div class="bottom_div"></div>
    </div>
    <table width="100%">
        <tr>
            <td width="60%"><strong>d) As despesas com aluguel e encargos cabe no orçamento dos interessados?</strong></td>
            <td width="20%">SIM |</td>
            <td width="18%">TALVEZ |</td>
            <td width="22%">NÃO</td>
        </tr>
        <tr>
            <td colspan="2" class="tr_color"><strong>e) Qual o valor total da renda comprovada? R$</strong></td>
            <td colspan="2" class="tr_color"><strong>E ela é:</strong></td>
        </tr>
        <tr>
            <td colspan="4">inferior a renda mínima desejada ou não conseguiram comprovar a renda mínima desejável</td>
        </tr>
        <tr>
            <td colspan="4" class="tr_color">Possui renda mínima desejável comprovada, mas não conseguiu comprovar outras rendas</td>
        </tr>
        <tr>
            <td colspan="4">Igual ou superior a mínima desejável, e comprovou a renda declarada.</td>
        </tr>
        <tr>
            <td colspan="4" class="tr_color">
                <strong>f) Qual a sua avaliação quanto as referências fornecidas pelo interessado?</strong>
            </td>
        </tr>
        <tr>
            <td>Ruim (não possui referências ou são fracas)</td>
        </tr>
        <tr>
            <td colspan="4" class="tr_color"> Boa </td>
        </tr>
        <tr>
            <td>Ótima (imobiliárias e informações bancárias podem ser ótimas referências)</td>
        </tr>
        <tr>
            <td colspan="4" class="tr_color">Observações, se houver:</td>
        </tr>
        <tr>
          <td><strong>g) Qual a relação dos bens do proponente ao AL.&EN.?</strong></td>
        </tr>
        <tr>
          <td colspan="4" class="tr_color">Ruim (BENS < 18 X AL.&EN.)</td>
        </tr>
        <tr>
          <td>Razoável (BENS > 18 X AL.&EN. , com alta liquidez)</td>
        </tr>
        <tr>
          <td colspan="4" class="tr_color">Bom (BENS > 48 x AL.&EN. , com baixa liquidez)</td>
        </tr>
        <tr>
          <td>Ótimo (BENS > 48 x AL.&EN. , com baixa liquidez e variados)</td>
        </tr>
    </table>

     <div class="text-center">
        <br/>
        <label class="text-info"><strong>PENDÊNCIAS</strong></label>
        <div class="bottom_div"></div>
    </div>

<div>
  <textarea name="" id="" cols="41" rows="40">Documentação</textarea>
  <textarea name="" id="" cols="41" rows="40">Outras</textarea>
</div>

    <div class="text-center">
        <br/>
        <label class="text-info"><strong>RESULTADO</strong></label>
        <div class="bottom_div"></div>
    </div>

    <table width="100%">
      <tr>
        <td><strong>Aprovado - </strong> Risco baixo (título 3 à 4x / Fiador regular)</td>
      </tr>
      <tr>
        <td class="tr_color"><strong>Aprovado - </strong> Risco moderado (título de 5 à 7x / Fiador bom)</td>
      </tr>
      <tr>
        <td><strong>Aprovado - </strong> Risco alto (título acima de 7x / Fiador muito bom) - considerar perfil do locador.</td>
      </tr>
      <tr>
        <td  class="tr_color"><strong>Reprovado</strong></td>
      </tr>
       <tr>
        <td>Observações:</td>
      </tr>
    </table>
</div>
<!--fim analise cadatral -->

<div style="width: 700px; height: 80px; background: ;">
  <br>
  <label for="" style="float: right;">Data: ____/____/______ </label>
</div>

<div style="height: 100px;" >
  <br/>
  <br/>
  <p style="background: ;width: 300px; float: left; ">
    ___________________________________<br>
    <label style="margin-left: 30px;"> Consultor Responsável</label>   
  </p>
   <p style="background: ;width: 300px; float: right; margin-top: -2px; ">
    ____________________________________<br>
    <label style="margin-left: 30px;">Revisor</label>
  </p>
   <br/>
</div>


    <?php
    if(is_null(@$selecao_especial))
    {
        echo "<p><strong>Obs: </strong> Não há alteração</p>";
    }else{
        foreach( $selecao_especial as  $changes){
            //LOCALIZANDO O NOVO USUÁRIO
            $filter_new_functionary['id'] = $changes['rel_prop_fun_new_id_user'];
            $new_functionary = $crud->select_common("users" , null, $filter_new_functionary , null );
                foreach ($new_functionary as $value) {
                    # code...
                    echo "<p><strong>Obs: </strong> O usuário ".$changes['nick']. " alterou atendente para o(a) ".$value['nick'].'</p>';
                }              
        }
    }
    
    ?>

</body>
</html>
