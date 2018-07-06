<?php

namespace App\Http\Controllers;

use App\Juego;
use App\User;
use Auth;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(Request $request, $game){
        $comment = $request->input('comment');
        $user = Auth::user();
        $juego = Juego::find($game);
        if($juego!=null){
            $comment=$juego->addComment($user,$comment);
            return response()->json([
                'success'=>true,
                'comment'=>$comment->toArray(),
                'userName'=>$user->name,
                'avatarUrl'=>$user->userAvatarPath(),
                'fechaDiff'=>$comment->fechaDiffHumans(),
            ]);
        }
        return response()->json(['error'=>'Juego invalido']);
    }
}
