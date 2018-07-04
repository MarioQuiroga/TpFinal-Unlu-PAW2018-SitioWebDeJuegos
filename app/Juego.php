<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{

    const featured =[
        'juego1',
        'juego2',
        'juego3'
    ];

    public static function getFeaturedGames()
    {
        $feat = [];
        foreach (self::featured as $nombre){
            array_push($feat,self::where('nombre_server',$nombre)->first());
        }
        return $feat;
    }

    public static function getHotGames()
    {
        return self::orderBy('valoracion_promedio','desc')->limit(9)->get();
    }

    public static function getIniciales()
    {
        return self::orderBy('fecha_creacion','desc')->limit(9)->get();
    }

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
