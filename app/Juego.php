<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function creador(){
        return $this->belongsTo('App\Creador');
    }

    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }

    public function valoracions(){
        return $this->belongsToMany('App\User','valoracions')
            ->withPivot('juego_id','usuario_id','estrellas');
    }



}
