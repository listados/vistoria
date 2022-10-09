<?php
namespace EspindolaAdm\Repository;

use EspindolaAdm\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactRepository
{
    static public function validatorContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => ['required', 'max:255'],
            'cnpj' => ['required'],
            'email' => ['required'],
            'phoneFixed' => ['required'],
            'creci' => ['required']
        ]);
        return $validator;
    }
}