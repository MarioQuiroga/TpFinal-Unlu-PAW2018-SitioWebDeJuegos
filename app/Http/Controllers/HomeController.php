<?php

namespace App\Http\Controllers;

use App\Juego;
use App\Tag;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {

        $this->auth=$auth;
        $this->middleware('auth',['except'=>['index','search']]);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featured = Juego::getFeaturedGames();
        $hots = Juego::getHotGames();
        $juegos = Juego::orderBy('fecha_creacion','desc')->simplePaginate(9);
        $mainTags = Tag::getMainTags();
        return view('index')->with(compact('featured'))
                                ->with(compact('hots'))
                                ->with(compact('juegos'))
                                ->with(compact('mainTags'));
    }

    public function search(Request $request){
        $searchStr = $request->input('searchGame');
        $games = Juego::where('titulo','like','%'.$searchStr.'%')->orWhere('descripcion','like','%'.$searchStr.'%')->orWhere('nombre_server','like','%'.$searchStr.'%')->get();
        if($searchStr){
            $tags=Tag::where('nombre','%'.$searchStr.'%')->get();
            foreach ($tags as $tag){
                $games->concat($tag->juegos());
            }
            return response()->json($games->toArray());
        }
    }
}
