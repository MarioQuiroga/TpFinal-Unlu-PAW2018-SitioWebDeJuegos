@extends('layouts.app')


@section('content')
	

	@if (isset($user))
		<div class="row">
			@component('utils.separador')
				<h1>{{ $creador['nombre']}}</h1>
			@endcomponent
			
			<div class="portada">
				<div class="userAvatar">
				<img src="{{ asset($creador->avatar) }} " class="imgAvatar">
				</div>				
			</div>
			@if(Auth::id() == $user->id)
					<div class="devButton">
						<button class="button"><a href="{{ url('dev/edit/'. $creador->id) }}"><b>Editar Perfil</b></a></button>	
						<button class="button"><a href="{{ url('games/create/'. $creador->id) }}"><b>Subir un Juego</b></a></button>	
						<button class="button"><a href="{{ url('user/'. $user->id) }}"><b>Ir a tu Usuario</b></a></button>	
					</div>					
			@endif		
		</div>

		@if (count($juegos)>0)			
					@component('utils.separador')
						<h1>Juegos</h1>
					@endcomponent
					<section class="hot-games">
					    <div class="games-mosaico">
					    @foreach($juegos as $game)
					        <div class="game-box" onclick="location.href='{{url('game/'.$game->nombre_server)}}'">
					            <div class="game-box-img">
					                <img src="{{asset('img/'. $game->nombre_server . '/'. $game->avatar)}}" alt="{{$game->titulo}}">
					            </div>
					            <p>
					                <b>{{$game->titulo}}</b>
					            </p>
					            <span class="valoracion">&#11088 {{ round($game->valoracion_promedio,1) }}</span>
					            <div class="tags">
					                @foreach($game->tags as $tag)
					                    <span class="tag">{{$tag->nombre}}</span>
					                @endforeach
					            </div>
					        </div>
					    @endforeach
					    </div>
					</section>
					
				@endif
	@endif


@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profileDev.css') }}">
@endsection