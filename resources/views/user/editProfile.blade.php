@extends('layouts.app')

@section('content')
	@if (isset($user))
		<div class="row">									
			@if(Auth::id() == $user->id)
				<form class="userDataForm" action="{{ $user->id }}" method="post" enctype="multipart/form-data">
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
							<button class="button"><a href="/user.profile{{ $user->id }}"><b>Cancelar</b></a></button>	
						</div>

					</div>
				</form>			
			@endif
		</div>
	@endif

@endsection

@section('script')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
	<script type="text/javascript" src="{{ asset('js/updateImg.js') }}"></script>
@endsection