<?php

namespace EspindolaAdm;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $prymaryKey = 'files_id';

    protected $fillable = ['files_id', 'files_name', 'files_profile', 'files_type', 'files_date', 'files_id_proposal'];
}
