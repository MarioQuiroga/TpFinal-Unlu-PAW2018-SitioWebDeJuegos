@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/index/carrusel.css')}}">
    {{--<link rel="stylesheet" type="text/css" href="css/progres.css">--}}
@endsection

@section('scripts')

    {{--<script type="text/javascript" src="js/progres.js"></script>--}}
    <script type="text/javascript" src="{{asset('js/index/carrusel.js')}}"></script>

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
<section class="carrusel" data-pos="0">

    <div class="carrusel-imgs">
        @foreach($featured as $feat)
            <div class="feat-game fade">
                <a href="">
                    <img src="{{asset('img/'. $feat->nombre_server . '/'. $feat->avatar)}}" alt="{{$feat->titulo}}">
                    <span class="game-title"> {{$feat->titulo}}</span>
                </a>
            </div>
        @endforeach
    </div>

    <a class="prev" onclick="mover(-1)">&#10094;</a>
    <a class="next" onclick="mover(+1)">&#10095;</a>
</section>
<div class="carrusel-dots">
    @for($i=1;$i<count($featured);$i++)
        <span class="carrusel-dot" onclick="cambiarA({{$i}})"></span>
    @endfor
</div>
<section class="featured-depts">
    <h2>Featured Departments <button onclick="personalizer.changeInformationView()"> Change View</button> </h2>

    <div class="imgBox">
        <div class="dept">
            <img src="imgs/fd1.jpg" alt="">
            <p><b>Lorem ipsum dolor</b> sit amet, consectetur adipiscing elit. Maecenas sollicitudin malesuada facilisis. Proin ultrices nisi lorem, at porttitor lacus tristique.
            </p>
        </div>
        <div class="dept">
            <img src="imgs/fd2.jpg" alt="">
            <p><b>Lorem ipsum dolor</b> sit amet, consectetur adipiscing elit. Maecenas sollicitudin malesuada facilisis. Proin ultrices nisi lorem, at porttitor lacus tristique.
            </p>
        </div>
        <div class="dept">
            <img src="imgs/fd3.jpg" alt="">
            <p><b>Lorem ipsum dolor</b> sit amet, consectetur adipiscing elit. Maecenas sollicitudin malesuada facilisis. Proin ultrices nisi lorem, at porttitor lacus tristique.
            </p>
        </div>
    </div>
</section>
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
