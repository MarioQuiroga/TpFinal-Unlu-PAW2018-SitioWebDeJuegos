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
        $hots = Juego::getHotGames();
        $juegos = Juego::getIniciales();
        return view('index')->with(compact('featured'))
                                ->with(compact('hots'))
                                ->with(compact('juegos'));
    }
}
