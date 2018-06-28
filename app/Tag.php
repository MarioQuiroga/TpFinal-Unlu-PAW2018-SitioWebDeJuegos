<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
   public function juegos(){
       return $this->belongsToMany('App\Tag');
   }
}
