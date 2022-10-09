<?php

namespace EspindolaAdm\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'address' => ['required', 'max:255'],
            'cnpj' => ['required'],
            'email' => ['required'],
            'phoneFixed' => ['required'],
            'creci' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'address.required' => 'O Endereço é obrigatório',
            'body.required' => 'A message is required',
        ];
    }
}
