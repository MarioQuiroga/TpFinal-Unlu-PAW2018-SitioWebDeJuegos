<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Creador;

class CreadorController extends Controller
{

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $user = User::find($id);
    	return view('creador.register')->with(compact('user'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        $user = User::find($id);
        /*$request->validate([
            'nameDev' => 'required',
            'inputFile' => 'required|file',
        ]);*/
        $fileName = $_FILES['inputFile']['name'];
        //$newFileName = $fileName.time().'.'.request()->fileToUpload->getClientOriginalExtension();
        $request->inputFile->store('juegos');
        $creador = Creador::create([
            'user_id'=> $user->id,
            'nombre'=>'KiwiJuegos',
        ]);

        return redirect('user/' . $user->id);
        //return redirect();
        //return view('');
        //return back()->withErrors(['msg', 'No se ha completado el registro']);

    }


     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /*
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
