<?php

namespace EspindolaAdm;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name', 'email', 'password', 'nick', 'id_profile' ,  'status', 'phone' , 'receive_proposal', 'avatar', 'adm'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    static public function getNameUser($id)
    {
        $user = User::find($id);
        return $user->nick;
    }

    static public function getNameAtendente($id)
    {
        $atendente_name = User::select('nick')->find($id);
        $atend_converter = json_decode($atendente_name, true);
       return $atend_converter['nick'];
    }
}
