@extends('layouts.app')

@section('meta')
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/gameView/game.css')}}">
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/gameView/gameView.js')}}"></script>
@endsection
@section('content')
    <section class="game-section">
        @if(View::exists('games/'.$name))
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
            <?php Auth::login(\App\User::find(1))?>
            @if(Auth::user())
                <div class="txt-center">
                    <div class="rating">
                        @php
                            $rating = Auth::user()->getRating($juego);
                        @endphp
                        @for($i=5;$i>0;$i--)
                            @if($rating == $i)
                                <input id="star{{$i}}" name="star" type="radio" value="{{$i}}" class="radio-btn hide" checked/>
                                <label for="star{{$i}}">☆</label>
                            @else
                                <input id="star{{$i}}" name="star" type="radio" value="{{$i}}" class="radio-btn hide" />
                                <label for="star{{$i}}">☆</label>
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
                    <img class="fav-heart" src="{{asset('img/full_Heart.png')}}" alt="Full Heart" id="fullHeart" {{$fullAux}}>
                    <img class="fav-heart" src="{{asset('img/Empty_Heart.png')}}" alt="Empty Heart" id="emptyHeart" {{$emptyAux}}>
                </div>
            @endif{{-- if(auth::user)--}}

        </section> {{-- / game data--}}
        <section class="comment-area">
            <h3>Comentarios</h3>
            @if(Auth::user())
                <section class="nuevo-comment">
                    <form action="{{url('game/'.$juego->id . '/comments')}}">
                        @csrf
                        <img src="{{asset(Auth::user()->avatar)}}" alt="avatar" class="comment-avatar">
                        <textarea class="paragraphInput" placeholder="Deja un comentario..." name="body"></textarea>
                        <button class="submit" type="submit"> Comentar </button>
                    </form>
                </section>
            @endif
            <section class="comentarios">
                @foreach($juego->comentarios as $comentario)
                <div class="comentario">
                    <div class="comment-user">
                        <span class="username">{{$comentario->user->name}}</span>
                        <img src="{{asset($comentario->user->avatar)}}" alt="avatar" class="comment-avatar">
                    </div>
                    <div class="comment-content">
                        <p>
                          {{$comentario->contenido}}
                        </p>
                    </div>
                </div>
                @endforeach
            </section>

        </section>
    @endif {{-- if($juego)--}}

    <section class="comentarios">

    </section>
@endsection

