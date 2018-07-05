@extends('layouts.app')


@section('content')
	<?php 
		setlocale(LC_TIME, 'spanish');
		Carbon\Carbon::setUtf8(true);

		$fechaC = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$user['created_at']);
		$fechaActual=$fechaC->formatLocalized('%d-%m-%Y');
	?>
	@if (isset($user))
		<div class="row">
			<div class="userAvatar">
				<img src="{{ asset($user->avatar) }} " class="imgAvatar">
			</div>
			<div class="userData">
				@if(Auth::id() == $user->id)
					@if(!$user->isCreador())
						<div class="devButton">
							<button class="button" ><a href="{{ url('register/dev/'. $user->id) }}"><b>Registrarse como Desarrollador</b></a></button>
						</div>	
					@else
						<div class="devButton">
							<button class="button"><a href="{{ url('edit/dev/'. $user->id) }}"><b>Perfil Desarrollador</b></a></button>	
						</div>	
					@endif
					<div class="devButton">
						<button class="button"><a href="{{ url('edit/'. $user->id) }}"><b>Editar Perfil</b></a></button>	
					</div>	

				@endif
				<h2>{{ $user['name']}}</h2>
				<h3>Fecha de Registro: {{ $fechaActual }}</h3>				
				@if (count($jugadas)>0)			
					<h3>Última Actividad</h3>
					@php
						$ultimaFecha = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$jugadas[0]['fecha']);
						$ultimaJugada=$fechaC->formatLocalized('%d-%m-%Y')->diffForHumans();					
					@endphp
					<h2><a href="juegos/{{ $jugadas[0]['juego_id'] }}">{{ $jugadas[0]['name'] }}</a> hace {{ $ultimaJugada }}</h2>
				@endif
				
				
			</div>
		</div>
	@endif
	@if (isset($jugadas))
		<div class="row">
			<div class="columnActivity">
				<h2>Actividad Reciente</h2>
				<table>
					@foreach ($jugadas as $jugada)
						<tr>
							<td>{{ $jugada['fecha'] }}</td>
							<td>{{ $jugada['name'] }}</td> 
							<td>Puntaje: {{ $jugada['puntaje'] }}</td>
						</tr>
					@endforeach
				</table>
			</div>
	@endif
	@if (isset ($favoritos))
	    <div class="columnFavoritos">
				<h2>Favoritos</h2>
				<ul>
					@foreach ($favoritos as $favorito)
						<li>
							
							<img src="{{ asset('avatarGames/'.$favorito['avatarJuego']) }}">
							<h3>{{ $favorito['name'] }}</h3>
							<div class="profileFavorito">
								<p>Rating: {{ $favorito['rating'] }}</p>
								<p>UserRating: {{ $favorito['userRating'] }}</p>
								<p>Máximo Puntaje: {{ $favorito['puntajeMaximo'] }}</p>
							</div>
						</li>
					@endforeach
				</ul>
		</div>
	</div>
	@else
		</div>		
	@endif
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endsection