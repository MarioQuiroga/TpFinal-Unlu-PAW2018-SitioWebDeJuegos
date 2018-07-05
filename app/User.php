<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Juego;

class User extends Authenticatable
{
    use Notifiable;
    const SIN_RATING = -1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function creador(){
        return $this->hasOne('App\Creador');
    }

    public function jugadas(){
        return $this->hasMany('App\Jugada')->get();
    }

    public function valoracions(){
        return $this->belongsToMany('App\Juego','valoracions')
            ->withPivot('juego_id','user_id','estrellas');
    }

    public function favoritos(){
        return $this->hasMany('App\Favorito');      
    }

    public function getActividad(){
        $aux = $this->jugadas();
        $jugadas = [];
        if (isset($aux)){

            for ($i=0; $i < $aux->count(); $i++) { 
                $jugadas[$i]['fecha'] = $aux[$i]->fecha;
                $jugadas[$i]['juego_id'] = $aux[$i]->juego_id;
                $jugadas[$i]['name'] = (Juego::where('juego_id',$aux[$i]->juego_id))->titulo;
                $jugadas[$i]['puntaje'] = $aux[$i]->puntaje;    

            }            
        }
        
        return $jugadas;
    }

    public function getFavoritos(){
        $aux = $this->favoritos();
        $favoritos = [];
        if (isset($aux)){
            for ($i=0; $i < $aux->count(); $i++) { 
                $favoritos[$i]['juego_id'] = $aux[$i]->juego_id;
                $juego = Juego::where('juego_id',$aux[$i]->juego_id);
                $favoritos[$i]['name'] = $juego->titulo;
                $favoritos[$i]['rating'] = $juego->valoracions()
                                                ->avg('estrellas');

                $favoritos[$i]['userRating'] = $juego->valoracions()
                                                    ->where('user_id', $this->id);

                $favoritos[$i]['puntajeMaximo'] = Jugada::where('user_id', $this->id)
                                                       ->where('juego_id', $aux[$i]->juego_id)
                                                       ->max('puntaje');              

                $favoritos[$i]['avatar'] = $juego['avatar'];
            }
        }
        return $favoritos;
    }
    
    public function isCreador(){
        if(count($this->creador()->get())==0){
            return false;    
        }else{
         return true;
        }
    }
    
    public function userAvatarPath(){        
        return '/avatars/' . $this->id . '/';
    }

    public function getRating (Juego $juego){
        $rating=self::SIN_RATING;
        $ratings = $this->valoracions;
        foreach ($ratings as $val){
            if($val->pivot->juego_id == $juego->id){
                $rating = $val->pivot->estrellas;
                break;
            }
        }
        return $rating;
    }

    public function updateRating (Juego $juego, $newRating){
        $oldRating = $this->getRating($juego);
        //Si no poseia rating
        if($oldRating==self::SIN_RATING){
            $this->valoracions()->attach($juego->id,['estrellas'=>$newRating]);
            $juego->newRating($newRating);
        } else { //si ya poseia rating solo actualizo
            $this->valoracions()->updateExistingPivot($juego->id,['estrellas'=>$newRating]);
            $juego->updateOldRating($oldRating,$newRating);
        }
    }

    public function isFavorito(Juego $juego){
        $favoritos = $this->favoritos;
        foreach ($favoritos as $fav){
            if($fav->id == $juego->id){
                return true;
            }
        }
        return false;
    }

    public function agregarFavorito(){

    }
}
