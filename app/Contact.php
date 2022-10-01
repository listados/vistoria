<?php

namespace EspindolaAdm;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'phoneFixed', 'phoneMobile', 'email', 'address', 'district', 
        'city', 'state', 'cep', 'creci', 'cnpj' 
    ];
}
