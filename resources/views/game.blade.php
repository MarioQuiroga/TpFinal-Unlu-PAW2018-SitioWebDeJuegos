@extends('layouts.app')

@section('meta')
    @if($juego)
        <meta name="game-id" content="{{ $juego->id }}">
    @endif
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/gameView/game.css')}}">
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/gameView/gameView.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/GameEngine.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            GameControl.init();
        });

    </script>
@endsection
@section('content')
    <section class="game-section">
        @if(View::exists('games.'.$name))
            @include('games/'.$name)
        @else
            <span class="error"> No hemos podido encontrar el juego {{$name}}</span>
        @endif
    </section>
    @if($juego)
        <section class="game-data">
            <div class="titulo-y-creador">
                <span class="game-title">{{$juego->titulo}}</span> by <a class="dev" href="{{url('dev/'.$juego->creador_id)}}">{{$juego->creador->nombre}}</a>
            </div>
            <!-- <?php /*Auth::login(\App\User::find(1))*/?> -->
            @if(Auth::user())
                <div class="txt-center">
                    <div class="rating">
                        @php
                            $rating = Auth::user()->getRating($juego);
                        @endphp
                        @for($i=5;$i>0;$i--)
                            @if($rating == $i)
                                <input id="star{{$i}}" name="star" type="radio" value="{{$i}}" class="radio-btn hide" onclick="GameControl.updateRating(this)" checked/>
                                <label for="star{{$i}}">☆</label>
                            @else
                                <input id="star{{$i}}" name="star" type="radio" value="{{$i}}" class="radio-btn hide" onclick="GameControl.updateRating(this)"/>
                                <label for="star{{$i}}" >☆</label>
                            @endif
                        @endfor
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="favorito">
                    @php
                        $fullAux='hidden';
                        $emptyAux='';
                        if(Auth::user()->isFavorito($juego)){
                            $fullAux='';
                            $emptyAux='hidden';
                        }
                    @endphp
                    <img class="fav-heart" src="{{asset('img/full_Heart.png')}}" alt="Full Heart" id="fullHeart" {{$fullAux}} onclick="GameControl.toggleFav(this)">
                    <img class="fav-heart" src="{{asset('img/Empty_Heart.png')}}" alt="Empty Heart" id="emptyHeart" {{$emptyAux}} onclick="GameControl.toggleFav(this)">
                </div>
            @endif{{-- if(auth::user)--}}

        </section> {{-- / game data--}}
        <section class="comment-area">
            <h3>Comentarios</h3>
            @if(Auth::user())
                <section class="nuevo-comment">
                    <form action="">
                        @csrf
                        <img src="{{asset(Auth::user()->userAvatarPath())}}" alt="avatar" class="comment-avatar">
                        <textarea class="paragraphInput" id="txt-comment" placeholder="Deja un comentario..." name="body"></textarea>
                        <button class="submit" type="submit" id="btn-comentar"> Comentar </button>
                    </form>
                </section>
            @endif
            <section class="comentarios" id="comentarios-cont">
                @foreach($juego->comentarios()->orderBy('created_at','desc')->get() as $comentario)
                <div class="comentario">
                    <div class="comment-user">
                        <span class="username"><a href="{{url('user/'.$comentario->user->id)}}">{{$comentario->user->name}}</a></span>
                        <img src="{{asset($comentario->user->userAvatarPath())}}" alt="avatar" class="comment-avatar">
                    </div>
                    <div class="comment-content">
                        <p>
                          {{$comentario->contenido}}
                        </p>
                    </div>
                    <span class="fecha-comment">{{$comentario->fechaDiffHumans()}}</span>
                </div>
                @endforeach
            </section>

        </section>
    @endif {{-- if($juego)--}}

    <section class="comentarios">

    </section>
@endsection

