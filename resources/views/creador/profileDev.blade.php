@extends('layouts.app')


@section('content')
	

	@if (isset($user))
		<?php 
			setlocale(LC_TIME, 'spanish');
			Carbon\Carbon::setUtf8(true);

			$fechaC = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$user['created_at']);
			$fechaActual=$fechaC->formatLocalized('%d-%m-%Y');
		?>
		<div class="row">
			<div class="userAvatar">
				<img src="{{ asset($user->avatar) }} " class="imgAvatar">
			</div>
			<div class="devData">
				@if(Auth::id() == $user->id)
					<div class="devButton">
						<button class="button"><a href="{{ url('edit/'. $user->id) }}"><b>Editar Perfil</b></a></button>	
					</div>
				@endif

				<h2>{{ $creador['nombre']}}</h2>
				<h3>Fecha de Registro: {{ $fechaActual }}</h3>				
				@if (count($juegos)>0)			
					<h3>Juegos</h3>
					@php
						$ultimaFecha = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$jugadas[0]['fecha']);
						$ultimaJugada=$fechaC->formatLocalized('%d-%m-%Y')->diffForHumans();					
					@endphp
					<h2><a href="juegos/{{ $jugadas[0]['juego_id'] }}">{{ $jugadas[0]['name'] }}</a> hace {{ $ultimaJugada }}</h2>
				@endif
				
				
			</div>
		</div>
	@endif


@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endsection