<section>
		<?php
			$url = null;
			if(!$user->isCreador()){		
				$url = url('register/dev/' . $user->id);
			}else{ 
				$url = url('games/create/' . $user->id);
			}		
		?>
		@component('utils.separador')
			<h3>Formulario para subir el juego</h3>
		@endcomponent		
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		<form action="{{ $url }}" method="post" class="formRegisterDev" enctype="multipart/form-data">
			@csrf
			@if(!$user->isCreador())
				<label for="nameDev">Nombre de Desarrollador</label>
				<input type="text" name="nameDev" id="nameDev" required>
			@endif

			<label for="titulo">Título del Juego</label>
			<input type="text" name="titulo" id="titulo" required>

			<label for="descripción">Breve descripción del Juego</label>
			<input type="text" name="descripcion" id="descripcion" required>	

			<label for="instrucciones">Instrucciones del Juego</label>
			<!--<textarea id="instrucciones" name="instrucciones"></textarea>-->
			<input type="text" name="instrucciones" id="instrucciones" required>	


			<label for="inputFile">Archivo .rar con el Juego</label>
			<input type="file" name="inputFile" id="inputGame" required>


			<button type="submit" class="button"><b>Guardar</b></button>
			<a href="{{url('user/' . $user->id)  }}" class="button"><b>Cancelar</b></a>
		</form>
</section>