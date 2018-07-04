<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public static function getMainTags()
    {
        $tags = self::all();
        $sortedTags=$tags->sortByDesc(function ($tag){
            return count($tag->juegos());
        });
        $mainTags=$sortedTags->take(10);

       return $mainTags;
       // return response()->json($mainTags->toJson());
    }

    public function juegos(){
       return $this->belongsToMany('App\Tag');
   }
}
