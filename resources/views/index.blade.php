@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/index/carrusel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/index/index.css')}}">
@endsection

@section('scripts')
        <script type="text/javascript" src="{{asset('js/index/carrusel.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Carrusel.init();
        });

    </script>
@endsection

@section('meta')
    <meta charset="UTF-8">
    <title>KiwiJuegos</title>
    <meta name="author" content="Bruno Crisafulli y Mario Quiroga">
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<section class="carrusel">

    {{--<a class="prev" onclick="Carrusel.mover(-1)">&#10094;</a>--}}

    <div class="carrusel-imgs">
        @foreach($featured as $feat)
            <div class="feat-game fade">
                <a href="">
                    <img src="{{asset('img/'. $feat->nombre_server . '/'. $feat->avatar)}}" alt="{{$feat->titulo}}">
                </a>
                <span class="game-title"> <h3>{{$feat->titulo}}:</h3>{{$feat->descripcion}}</span>
            </div>
        @endforeach
    </div>

    <div class="carrusel-dots">
        @for($i=1;$i<=count($featured);$i++)
            <span class="carrusel-dot" onclick="Carrusel.cambiarA({{$i}})"></span>
        @endfor
    </div>
    {{--<a class="next" onclick="Carrusel.mover(+1)">&#10095;</a>--}}
</section>
@include('utils.separador')
<section class="hot-games">
    <h1 style="color: firebrick">De aqui en adelante estamos construyendo...</h1>
    <h2>Hot Games</h2>
    <div class="games-mosaico">
    @foreach($hots as $hotGame)
        <div class="game-box">
            <img src="{{asset('img/'. $hotGame->nombre_server . '/'. $hotGame->avatar)}}" alt="{{$hotGame->titulo}}">
            <p>
                <b>{{$hotGame->titulo}}:</b> {{$hotGame->descripcion}}
            </p>
        </div>
    @endforeach
    </div>
</section>
@include('utils.separador')
<section class="container">
    <img class="brand-logos" src="imgs/brandLogos.jpg" alt="brand logos">
</section>
<div class="garabatosBox">
    <section class="main-garab">
        <article>
            <h2>Lorem ipsum dolor</h2>
            <p> sit amet, consectetur adipiscing elit. Maecenas sollicitudin malesuada facilisis. Proin ultrices nisi lorem, at porttitor lacus tristique.</p>
        </article>
        <article style="display: none">
            <h2>title</h2>
            <p>sit amet, consectetur adipiscing elit. Maecenas sollicitudin malesuada facilisis. Proin ultrices nisi lorem, at porttitor lacus tristique.</p>
        </article>
        <article style="display: none">
            <h2>title</h2>
            <p>sit amet, consectetur adipiscing elit. Maecenas sollicitudin malesuada facilisis. Proin ultrices nisi lorem, at porttitor lacus tristique.</p>
        </article>
    </section>
    <div class="vertical-border"></div>
    <article class="garab">
        <h2>Lorem ipsum dolor</h2>
        <p>sit amet, consectetur adipiscing elit. Maecenas sollicitudin malesuada facilisis. Proin ultrices nisi lorem, at porttitor lacus tristique.</p>
    </article>
    <div class="vertical-border"></div>
    <article class="garab">
        <h2>Lorem ipsum dolor</h2>
        <p>sit amet, consectetur adipiscing elit. Maecenas sollicitudin malesuada facilisis. Proin ultrices nisi lorem, at porttitor lacus tristique.</p>
    </article>

</div>
@endsection
