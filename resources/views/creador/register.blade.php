@extends('layouts.app')

@section('content')
	

	<header>
		@component('utils.separador')
			<h2>Registrarse como Desarrollador</h2>

		@endcomponent
	</header>
	

	<section>
		<form action="{{url('register/dev/' . $user->id)  }}" method="post" class="formRegisterDev" enctype="multipart/form-data">
			@csrf
			<label for="nameDev">Nombre de Desarrollador</label>
			<input type="text" name="nameDev" id="nameDev" required>

			<label for="inputFile">Para ser desarrollador, debe subir un Archivo .rar con un juego</label>
			<input type="file" name="inputFile" id="inputFile" required>


			<button type="submit" class="button"><b>Guardar</b></button>
			<a href="{{url('user/' . $user->id)  }}"><b>Cancelar</b></a>
		</form>
	</section>


@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/creador.css') }}">	
@endsection