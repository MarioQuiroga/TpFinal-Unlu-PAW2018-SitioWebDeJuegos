<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function juego(){
        return $this->belongsTo('App\Juego');
    }
}
