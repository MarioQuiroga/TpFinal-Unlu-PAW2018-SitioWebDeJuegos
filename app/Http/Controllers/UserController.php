<?php

namespace App\Http\Controllers;

use App\Juego;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['edit','toggleFav','updateRating']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //    	
    	try{
    		$user = User::find($id);            
            /*$jugadas = $user->getActividad();
            $favoritos = $user->getFavoritos();*/
            return view('user.profile') ->with(compact('user'))
                                        /*->with(compact('jugadas'))
                                        ->with(compact('favoritos'))*/;
    	}catch (Exception $e){
    		return view('home');
    	}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function edit($id){
        $user = User::find($id);
        return view('user.editProfile')->with(compact('user'));
    }

     /*
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $user = User::find($id);
        if ($user !== null){
            if(request()->input('name')!==null){
                $user->name = request()->input('name');
            }

            if (!empty($_FILES['inputFile']) && $_FILES['inputFile']['error'] == UPLOAD_ERR_OK)
            {
                    $filePath = $_FILES['inputFile']['tmp_name'];
                    $fileName = $_FILES['inputFile']['name'];
                    $image = Image::make($filePath);
                    //Si no existe el directorio de usuario lo creo
                    File::exists(public_path() . $user->userAvatarPath()) or File::makeDirectory(public_path() . $user->userAvatarPath());
                    $newFileName = $this->changeFileName($fileName);                
                    $image->save(public_path() . $user->userAvatarPath() . $newFileName);
                    $user->avatar = $user->userAvatarPath() . $newFileName;
            }

            $user->save();
        }
        return redirect('user/'.$id);
    }

    private function changeFileName($name){
        $ext = strtolower(substr($name, strripos($name, '.') + 1));
        $filename = round(microtime(true)) . mt_rand() . '.' . $ext;
        return $filename;
    }

    public function toggleFav($game){
        $user = Auth::user();
        if($user!=null){
            $user->toggleFavorito($game);
            return response()->json(['estado'=>$user->isFavorito(Juego::find($game))]);
        }else{
            return response()->json(['error'=>'usuario no logueado']);
        }
    }

    public function updateRating(Request $request,$game){
        $user = Auth::user();
        $rating = $request->input('rating');
        if($user!=null){
            $user->updateRating(Juego::find($game),$rating);
            return response()->json(['succes'=>'ok']);
        }else{
            return response()->json(['error'=>'usuario no logueado']);
        }
    }
}
