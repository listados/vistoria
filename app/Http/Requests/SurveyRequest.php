<?php

namespace EspindolaAdm\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Testing\HttpException as TestingHttpException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SurveyRequest extends FormRequest
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
			'survey_locator_name' => 'required',
        ];
    }

	public function messages()
	{
		return [
			'required' => 'Campo obrigatório',
		];
	}

	protected function failedValidation(Validator $validator)
	{
		$errors = (new ValidationException($validator))->errors();
		throw new HttpException(
			response()->json(['messagem'  =>  $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
		 );


	}
}
