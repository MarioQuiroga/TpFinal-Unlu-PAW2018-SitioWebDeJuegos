<?php

namespace App\Http\Controllers;

use App\Juego;
use Illuminate\Http\Request;
use App\Creador;
use App\User;

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

    
    public function create($id){
        $creador = Creador::find($id);
        $user = User::find($creador->user_id);
        return view('juego.create')->with(compact('user'))
                                   ->with(compact('creador'));

    }


    public function store(Request $request, $id){

         $validatedData = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'instrucciones' => 'required',
            'inputFile' => 'required',
        ]);

        if(isset($_FILES['inputFile']['name'])){
            $name = strtolower($request->input('titulo'));
            $newFileName = round(microtime(true)) . mt_rand() . '.' . $name;
            $carbon = new \Carbon\Carbon();
            $date = $carbon->now()->format('Y-m-d');
            $creadorId = Creador::find($id);
            $juego = Juego::create([
                    'creador_id'=> $creadorId->id,
                    'descripcion'=>$request->input('descripcion'),
                    'titulo'=>$request->input('titulo'),
                    'instrucciones'=>$request->input('instrucciones'),
                    'nombre_server'=> $newFileName,
                    'fecha_creacion'=>$date,

            ]);
            return redirect('dev/' . $id);            
        }else{     
            return back()->withErrors(['msg', 'No se ha completado el registro']);
        }
    }

}
