<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts'; //Es el nombre del modelo en minuscula y plural (= default)
    public $primaryKey = 'id';  //Puedo especificar el campo que desee como clave primaria
    public $timestamps = true;  //Puedo especificar si quiero timestamps (true por default)

    public function user(){
        return $this->belongsTo('App\User');

    }
}
