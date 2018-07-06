<?php

namespace App\Http\Controllers;

use App\Juego;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    public function __construct()
    {

    }

    public function show($name)
    {
        $juego = Juego::where('nombre_server',$name)->first();
        return view('game')->with(compact('name'))
                                ->with(compact('juego'));
    }

    

    public function store($id){

    }

}
