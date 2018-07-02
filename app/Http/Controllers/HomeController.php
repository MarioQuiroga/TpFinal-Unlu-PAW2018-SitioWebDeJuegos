<?php

namespace App\Http\Controllers;

use App\Juego;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featured = Juego::getFeaturedGames();
        $hot = Juego::getHotGames();
        $juegos = Juego::getIniciales();
        return view('home')->with(compact('featured'))
                                ->with(compact('hot')
                                ->with(compact('juegos')));
    }
}
