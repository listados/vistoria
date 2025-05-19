<?php

namespace EspindolaAdm;

use Illuminate\Database\Eloquent\Model;

class SurveyHistory extends Model
{
    protected $table = 'survey_histories'; 

    protected $fillable = [
        'survey_id',
        'user_id',
        'field',
        'old_value',
        'new_value',
        'changed_at',
    ];

    public $timestamps = true; 

    protected $dates = ['changed_at'];
}
 