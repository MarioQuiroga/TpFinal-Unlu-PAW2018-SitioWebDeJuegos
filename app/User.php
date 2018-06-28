<?php

namespace App;

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
        'name', 'email', 'password',
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
        return $this->hasMany('App\Jugada');
    }

    public function valoracions(){
        return $this->belongsToMany('App\Juego','valoracions')
            ->withPivot('juego_id','usuario_id','estrellas');
    }


}
