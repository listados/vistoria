<?php

namespace EspindolaAdm;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teamSites';

    protected $fillable = [
        'teamSites_office',
        'teamSites_name',
        'teamSites_phoneOne',
        'teamSites_phoneTwo',
        'teamSites_text',
        'teamSites_linkedin',
        'teamSites_photo',
    ];
}
