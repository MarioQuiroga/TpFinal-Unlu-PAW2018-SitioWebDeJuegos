@extends('layouts.app')


@section('content')
	<header>
		@component('utils.separador')
			<h2>Subir un Juego</h2>
		@endcomponent
	</header>
	@include('creador.tutorial')

	@include('creador.uploadGame')

@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/creador.css') }}">	
@endsection

