<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Creador;
use App\Juego;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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
        $validatedData = $request->validate([
            'nameDev' => 'required',
            'titulo' => 'required',
            'descripcion' => 'required',
            'instrucciones' => 'required',
            'inputFile' => 'required',
        ]);

        $user = User::find($id);        
        if(isset($_FILES['inputFile']['name'])){
            $request->inputFile->store('juegos');
            $creador = Creador::create([
                'user_id'=> $user->id,
                'nombre'=>$request->input('nameDev'),
            ]);
            
            $name = strtolower($request->input('titulo'));
            $newFileName = round(microtime(true)) . mt_rand() . '.' . $name;
            $creadorId = $user->creador->id;

            $carbon = new \Carbon\Carbon();
            $date = $carbon->now()->format('Y-m-d');
            $juego = Juego::create([
                'creador_id'=> $creadorId,
                'descripcion'=>$request->input('descripcion'),
                'titulo'=>$request->input('titulo'),
                'instrucciones'=>$request->input('instrucciones'),
                'nombre_server'=> $newFileName,
                'fecha_creacion'=>$date,

            ]);

            return redirect('dev/' . $creador->id);
        }else{            

            return back()->withErrors(['msg', 'No se ha completado el registro']);
        }

    }

    public function show($id){
        $creador = Creador::find($id);
        $user = User::find($creador->user_id);
        $juegos = Juego::where('creador_id', $creador->id)->get();
        return view('creador.profileDev')->with(compact('juegos'))
                                         ->with(compact('user'))
                                         ->with(compact('creador'));
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
        $creador = Creador::find($id);
        $user = User::find($creador->user_id);
        return view('creador.editprofileDev')->with((compact('user')))
                                             ->with((compact('creador')));

    }

    /*
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $creador = Creador::find($id);
        if ($creador !== null){
            if(request()->input('name')!==null){
                $creador->nombre = request()->input('name');
            }

            if (!empty($_FILES['inputFile']) && $_FILES['inputFile']['error'] == UPLOAD_ERR_OK)
            {
                    $filePath = $_FILES['inputFile']['tmp_name'];
                    $fileName = $_FILES['inputFile']['name'];
                    $image = Image::make($filePath);
                    //Si no existe el directorio de creador lo creo
                    File::exists(public_path() . $creador->avatarPath()) or File::makeDirectory(public_path() . $creador->avatarPath());

                    $ext = strtolower(substr($fileName, strripos($fileName, '.') + 1));
                    $newFileName = round(microtime(true)) . mt_rand() . '.' . $ext;
                
                    $image->save(public_path() . $creador->avatarPath() . $newFileName);
                    $creador->avatar = $creador->avatarPath() . $newFileName;
            }

            $creador->save();
        }
        return redirect('dev/'.$id);

    }
}
