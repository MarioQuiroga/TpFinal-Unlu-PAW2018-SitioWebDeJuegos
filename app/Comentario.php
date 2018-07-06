<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{

    protected $guarded=[];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function juego(){
        return $this->belongsTo('App\Juego');
    }

    public function fechaDiffHumans(){
        setlocale(LC_TIME, 'spanish');
        Carbon::setLocale('es');
        Carbon::setUtf8(true);
        return Carbon::createFromFormat('Y-m-d H:i:s',$this->created_at)->diffForHumans();
    }
}
