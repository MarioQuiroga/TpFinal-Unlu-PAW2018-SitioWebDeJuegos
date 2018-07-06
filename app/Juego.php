<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{

    /*
     * Deben asignarse nombre_server => nombre_imagen
     *
     * La imagen debe ser 1280*500
     * */

    protected $guarded = [];

    const featured =[
        'juego1'=>'zombieFeat.jpg',
        'juego2'=>'pongFeat.jpg',
        'juego3'=>'puzzleFeat.jpg'
    ];
    public $featImage;

    public static function getFeaturedGames()
    {
        $feat = [];
        foreach (self::featured as $nombre=>$img){
            $game = self::where('nombre_server',$nombre)->first();
            if($game!=null){
                $game->featImage = $img;
                array_push($feat,$game);
            }
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
            ->withPivot('juego_id','user_id','estrellas');
    }

    public function toArray()
    {
        $arr= parent::toArray();
        $tags= $this->tags->toArray();
        $arr['tags']=$tags;
        return $arr;
    }

    public function newRating($newRating)
    {
        $cantTotal = ($this->cant_valoraciones * $this->valoracion_promedio)+$newRating;
        $this->valoracion_promedio = $cantTotal / ($this->cant_valoraciones + 1);
        $this->save();
    }

    public function updateOldRating($oldRating, $newRating)
    {
        $cantTotal = ($this->cant_valoraciones * $this->valoracion_promedio)+$newRating-$oldRating;
        $this->valoracion_promedio = $cantTotal / ($this->cant_valoraciones);
        $this->save();
    }

    public function getRutaAvatar(){
        return 'img/'.$this->nombre_server.'/'.$this->avatar;
    }

    public function addComment(User $user, string $comment){
        return Comentario::create([
           'juego_id'=>$this->id,
           'user_id'=>$user->id,
           'fecha'=>Carbon::now()->format('Y-m-d'),
           'contenido'=>self::basicSanitize($comment),
        ]);
    }

    public static function basicSanitize($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
