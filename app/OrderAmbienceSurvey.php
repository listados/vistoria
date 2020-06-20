<?php

namespace EspindolaAdm;

use Illuminate\Database\Eloquent\Model;

class OrderAmbienceSurvey extends Model
{
    protected $table = "order_ambience_survey";

    protected $primaryKey = "order_ambience_survey_id";

    protected $fillable = [
        'order_ambience_survey_id_survey',
        'order_ambience_survey_order',
        'order_ambience_survey_list_order'
    ];
}
