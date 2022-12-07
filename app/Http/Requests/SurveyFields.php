<?php

namespace EspindolaAdm\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyFields extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'survey_inspetor_name' => 'required|max:50',
            'survey_inspetor_cpf' => 'max:30',
            'survey_date' => 'max:30',
            'survey_address_immobile' => 'string|nullable|max:100',
            'survey_type_immobile' => 'max:30|nullable',
            'survey_energy_meter' => 'string|nullable|max:30',
            'survey_energy_load' => 'string|nullable|max:30',
            'survey_water_meter' => 'string|nullable|max:30',
            'survey_water_load' => 'string|nullable|max:30',
            'survey_gas_meter' => 'string|nullable|max:30',
            'survey_gas_load' => 'string|nullable|max:30',
            // 'survey_keys' => 'required|min:3|string',
            'survey_code' => 'max:30',
            'survey_link_tour' => 'active_url|min:7'
        ];
    }
}
