<?php

namespace EspindolaAdm;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    protected $primaryKey 	= 'keys_id';
    protected $table 		= 'keys';
	protected $fillable  	= ['keys_code', 'keys_cod_immobile', 'keys_status' , 'keys_devolution' , 'keys_ps'];
}
