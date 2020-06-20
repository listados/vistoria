<?php

namespace EspindolaAdm;

use Illuminate\Database\Eloquent\Model;

class Ambience extends Model
{
   protected $table = "ambience";

   protected $primaryKey = "ambience_id";

   protected $fillable = [
       'ambience_name'
   ];

   static function getNameAmbience($id_ambience)
   {
        $listAmbience = [];
        $listAmbience = array_push($listAmbience,$id_ambience );
        return $listAmbience;

   }
}
