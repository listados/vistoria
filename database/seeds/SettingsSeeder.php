<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->insert([
            'settings' => 1,
            'settings_description' => 'edit_profile_proposal',
            'settings_id_user' => 8,
            'created_at' => '2018-08-29 15:54:29',
            'updated_at' => '2016-07-08 00:00:00',
            'settings_id_profile' => 8,
            'settings_aspect_general_active' => 1,
            'settings_aspect_general' => "<p><strong>Caracter&iacute;sticas do im&oacute;vel</strong>: Apartamento com Sala, 3 quartos com arm&aacute;rios (sendo 1 su&iacute;te com box), banheiro social com box, cozinha com arm&aacute;rios, &aacute;rea de servi&ccedil;o. Ambientes: Sala, Quarto 01, Quarto 02, Su&iacute;te, WC Su&iacute;te, WC Social, Cozinha e &Aacute;rea de Servi&ccedil;o.</p>\r\n\r\n<p><strong>Faxinado</strong>: Sim</p>\r\n\r\n<p><strong>Mobiliado</strong>: N&atilde;o, mas com arm&aacute;rios fixos de madeira em todos os quartos, na cozinha e na &aacute;rea de servi&ccedil;o. &nbsp;</p>\r\n\r\n<p><strong>Piso</strong>: Porcelanato branco, exceto nos banheiros que &eacute; cer&acirc;mica.</p>\r\n\r\n<p><strong>Paredes</strong>: Pintura em l&aacute;tex na cor creme, exceto nos banheiros e na cozinha que &eacute; cer&acirc;mica.</p>\r\n\r\n<p><strong>Teto</strong>: Pintura em l&aacute;tex na cor branco neve, exceto no banheiro que s&atilde;o forrados em PVC.</p>\r\n\r\n<p><strong>Portas e Portais</strong>: Entrada da sala com 02 portas e 02 portais, sendo a primeira em alum&iacute;nio e a segunda de madeira, ambas com fechaduras; entrada da cozinha tamb&eacute;m com 02 portas e 02 portais, sendo a primeira em alum&iacute;nio e a segunda de madeira, ambas com fechaduras; portal e porta dos quartos e dos banheiros com porta modelo sanfonada em PVC, todas com trava.</p>\r\n\r\n<p><strong>Instala&ccedil;&atilde;o hidr&aacute;ulica:</strong> Em perfeito funcionamento, sem ressalvas.</p>\r\n\r\n<p><strong>Instala&ccedil;&atilde;o el&eacute;trica:</strong> Em perfeito funcionamento, sem ressalvas.</p>",
            'settings_reservation' => "<p>No im&oacute;vel vistoriado foram constatadas as seguintes ressalvas:</p>\r\n\r\n<strong>Sala</strong>\r\n<ol>\r\n\t<li>&nbsp;Fechadura com dificuldade para fechar;</li>\r\n</ol>\r\n\r\n<strong>Quarto 01</strong>\r\n<ol>\r\n\t<li>&nbsp;Faltando trava da porta sanfonada de PVC;</li>\r\n</ol>\r\n<strong>Quarto 02</strong>\r\n<ol>\r\n\t<li>&nbsp;Trava da porta sanfonada de PVC com dificuldade para fechar;</li>\r\n</ol>\r\n\r\n<strong>&Aacute;rea de servi&ccedil;o</strong>\r\n<ol>\r\n\t<li>&nbsp;Algumas cer&acirc;micas danificadas, conforme registros fotogr&aacute;ficos;</li>\r\n\t<li>Arm&aacute;rio da lavanderia com porta desregulada.</li>\r\n</ol>",
            'settings_reservation_active' => 1,
            'settings_provisions' => "<p><strong>VII&nbsp;-&nbsp;</strong>O im&oacute;vel possui condi&ccedil;&otilde;es de uso e habitabilidade, e se encontra em perfeito estado de conserva&ccedil;&atilde;o com tudo funcionando,&nbsp;<ins><strong>ressalvado&nbsp;</strong>eventuais defeitos existentes que est&atilde;o expressos no presente termo.</ins></p>\r\n\r\n<p><strong>VIII - O</strong>&nbsp;Tour Virtual, as imagens comuns e as em 360&ordm; est&atilde;o hospedadas no dom&iacute;nio&nbsp;<a href=\"http://www.espindolaimobiliaria.com.br/\">www.espindolaimobiliaria.com.br</a>,&nbsp;todas publicadas at&eacute; a presente data, s&atilde;o provas digitais aceitas por todas as partes e que servir&atilde;o como fonte para esclarecer d&uacute;vidas que possam surgir ao final da loca&ccedil;&atilde;o.</p>\r\n\r\n<p><strong>IX -&nbsp;</strong>O(s) locat&aacute;rio(s) disp&otilde;e(m) de 05 (cinco) dias &uacute;teis, a partir desta data, para contesta&ccedil;&atilde;o, por e-mail, do presente termo de vistoria, o qual s&oacute; ter&aacute; efeito ap&oacute;s reconhecimento por escrito pelo Locador(a) ou pela sua procuradora (imobili&aacute;ria).</p>\r\n\r\n<p><strong>X -&nbsp;</strong>&Eacute; vedado ao(s) LOCAT&Aacute;RIO(S) realizar(em) qualquer tipo de furo nas cer&acirc;micas do im&oacute;vel, sob pena de ter(em) que substituir as cer&acirc;micas danificadas por novas da mesma cor e modelo.</p>\r\n\r\n<p><strong>XI -&nbsp;</strong>Os locat&aacute;rios declaram que receberam neste ato as chaves e os demais itens m&oacute;veis acima especificados, e que est&atilde;o cientes de que o aluguel e encargos come&ccedil;am a ser cobrados a partir desta data.</p>",
            'settings_keys_active' => 1,
            'settings_keys' => "<p>Declaro(amos) ter recebido neste ato as seguintes chaves e acess&oacute;rios do im&oacute;vel:</p>\r\n\r\n<p>- 02 Chaves da porta principal (entrada);</p>\r\n\r\n<p>- 01 chave da su&iacute;te;</p>\r\n\r\n<p>- 01 chave do quarto;</p>\r\n\r\n<p>- 03 tapa ralos de pia;</p>\r\n\r\n<p>- 01 v&aacute;lvula para ralo de pia;</p>\r\n\r\n<p>- 01 interfone da marca IntelBr&aacute;s.</p>",
            'settings_date_last_sync' => '2018-08-29 15:54:29',
            'settings_total_immobile_sync' => 101,
            'settings_id_user_sync' => 11,
        ]);
    }
}
