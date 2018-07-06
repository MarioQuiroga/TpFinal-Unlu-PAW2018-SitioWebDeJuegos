@extends('layouts.app')


@section('content')
	<?php 
		setlocale(LC_TIME, 'spanish');
		Carbon\Carbon::setUtf8(true);

		$fechaRegC = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$user->created_at);
		$fechaReg=$fechaRegC->formatLocalized('%d-%m-%Y');
	?>
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
                        <button class="button"><a href="{{ url('dev/'. $user->id) }}"><b>Perfil Desarrollador</b></a></button>
                    </div>
                @endif
                <div class="devButton">
                    <button class="button"><a href="{{ url('edit/'. $user->id) }}"><b>Editar Perfil</b></a></button>
                </div>


            @endif
            <h2>{{ $user->name}}</h2>
            <h3>Fecha de Registro: {{ $fechaReg }}</h3>
            @if (count($user->jugadas)>0)
                <h3>Última Actividad</h3>
                @php
                    $ultimoJuego = $user->ultimoJuegoJugado();
                    $fechaUltimaJugada = $user->fechaUltimaJugada();
                @endphp
                <h2><a href="juegos/{{$ultimoJuego->id}}">{{$ultimoJuego->titulo}}</a> hace {{ $ultimaJugada->diffForHumans() }}</h2>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="columnActivity">
            <h2>Actividad Reciente</h2>
            <table>
                @foreach ($user->jugadas as $jugada)
                    <tr>
                        <td>{{ $jugada->fecha }}</td>
                        <td>{{ $jugada->juego->titulo }}</td>
                        <td>Puntaje: {{ $jugada->puntaje }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="columnFavoritos">
            <h2>Favoritos</h2>
            <ul>
                @foreach ($user->favoritos as $juegoFav)
                    @php
                        $rating = $user->getRating($juegoFav);
                        if($rating==\App\User::SIN_RATING){
                            $rating='Sin rating';
                        }
                    @endphp
                    <li>
                        <img src="{{ asset($juegoFav->getRutaAvatar()) }}">
                        <h3>{{ $juegoFav->titulo }}</h3>
                        <div class="profileFavorito">
                            <p>Rating global: {{ $juegoFav->valoracion_promedio }}</p>
                            <p>Rating de {{$user->name}}:{{ $rating }}</p>
                            <p>Máximo Puntaje: {{$user->getMaxPuntaje($juegoFav) }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>

		</div>
	</div>
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endsection