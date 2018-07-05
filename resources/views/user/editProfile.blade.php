@extends('layouts.app')

@section('content')
	@if (isset($user))
		<div class="row">									
			@if(Auth::id() == $user->id)
				<form class="userDataForm" action="{{url('user/' . $user->id)  }}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="editAvatar">
						<img src="{{ asset($user->avatar) }} " class="imgAvatar" id="imgAvatar"><br>
						<div class="inputFileDiv">
							<input type="file" name="inputFile" id="inputFile" onchange="updateImg()">
						</div>
					</div>
					<div class="formData">
						<label for="name">Nombre de Usuario</label>
						<input class="inputForm" type="text" name="name" value="{{ $user['name']}}"  id="inputUserName">					
		   				
						<div class="editButton">
							<button type="submit" class="button"><b>Guardar Cambios</b></button>
							<a href="{{url('user/' . $user->id)  }}"><b>Cancelar</b></a>
						</div>

					</div>
				</form>			
			@endif
		</div>
	@endif

@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">	
@endsection

@section('sctrips')
	<script type="text/javascript" src="{{ asset('js/updateImg.js') }}"></script>
@endsection