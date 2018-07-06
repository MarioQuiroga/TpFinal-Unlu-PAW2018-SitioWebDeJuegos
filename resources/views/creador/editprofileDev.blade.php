@extends('layouts.app')


@section('content')
	
	<section>
		@if (isset($creador))
		<div class="row">									
			@if(Auth::id() == $user->id)
				<form class="userDataForm" action="{{url('dev/edit/' . $creador->id)  }}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="formData">
						<label for="name">Nombre del Desarrollador</label>
						<input class="inputForm" type="text" name="name" value="{{ $creador->nombre}}"  id="inputUserName">					
		   				
		   				<label class="labelPortada" >Imagen de portada</label><br>
		   				<img src="{{ asset($creador->avatar) }} " class="portada" id="imgAvatar"><br>
						<div class="inputFileDiv">
							<input type="file" name="inputFile" id="inputFile" onchange="updateImg()">
						</div>

						<div class="editButton">
							<button type="submit" class="button"><b>Guardar Cambios</b></button>
							<a href="{{url('dev/' . $creador->id)  }}" class="button" ><b>Cancelar</b></a>
						</div>

					</div>
				</form>			
			@endif
		</div>
	@endif
	</section>

@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/creador.css') }}">	
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/updateImg.js') }}"></script>
@endsection