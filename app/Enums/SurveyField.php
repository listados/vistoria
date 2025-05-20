<?php

namespace EspindolaAdm\Enums;

class SurveyField
{
    public static $labels = [
        'survey_id' => 'ID da Vistoria',
        'survey_date' => 'Data da Vistoria',
        'survey_general_aspects' => 'Aspectos Gerais',
        'survey_reservation' => 'Reservas',
        'survey_status' => 'Status',
        'survey_finalized_date' => 'Data de Finalização',
        'survey_keys' => 'Chaves',
        'survey_code' => 'Código da Vistoria',
        'survey_link_tour' => 'Link do Tour Virtual',
        'survey_provisions' => 'Disposições',
        'survey_filed' => 'Arquivada',
        'survey_type' => 'Tipo de Vistoria',
        'survey_address_immobile' => 'Endereço do Imóvel',
        'survey_type_immobile' => 'Tipo do Imóvel',
        'survey_energy_meter' => 'Leitura do Medidor de Energia',
        'survey_energy_load' => 'Carga de Energia',
        'survey_water_meter' => 'Leitura do Medidor de Água',
        'survey_water_load' => 'Carga de Água',
        'survey_gas_meter' => 'Leitura do Medidor de Gás',
        'survey_gas_load' => 'Carga de Gás',
        'survey_date_register' => 'Data de Registro',
        'survey_inspetor_name' => 'Nome do Inspetor',
        'survey_inspetor_cpf' => 'CPF do Inspetor',
        'created_at' => 'Criado em',
        'updated_at' => 'Atualizado em',
    ];

    public static function get(string $key)
    {
        return self::$labels[$key] ?? $key;
    }
}
