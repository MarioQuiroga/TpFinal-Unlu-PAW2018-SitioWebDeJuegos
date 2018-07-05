<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{
    //

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
            $jugadas = $user->getActividad();    
            $favoritos = $user->getFavoritos();
            return view('user.profile') ->with(compact('user'))
                                        ->with(compact('jugadas'))
                                        ->with(compact('favoritos'));        		
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

           // if (!empty($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {

                //$input = Input::all();
                //$fileName = $request->file('inputFile');
                //dd($fileName);
                //$image = Image::make($fileName);
                $filePath = $_FILES['inputFile']['tmp_name'];
                $fileName = $_FILES['inputFile']['name'];
                //dd($fileName);
                $image = Image::make($filePath);
                //Si no existe el directorio de usuario lo creo
                File::exists(public_path() . $user->userAvatarPath()) or File::makeDirectory(public_path() . $user->userAvatarPath());
                $newFileName = $this->changeFileName($fileName, $user->id);
                //var_dump($user->userAvatarPath());
                //var_dump($newFileName);
                $image->save(public_path() . $user->userAvatarPath() . $newFileName);
                $user->avatar = $user->userAvatarPath() . $newFileName;
                //return $fileName;
            //}

            $user->save();
       }
        return redirect('user/'.$id);
    }

    private function changeFileName($name, $id){
        $ext = strtolower(substr($name, strripos($name, '.') + 1));
        $filename = round(microtime(true)) . mt_rand() . '.' . $ext;
        return $filename;
    }
}
