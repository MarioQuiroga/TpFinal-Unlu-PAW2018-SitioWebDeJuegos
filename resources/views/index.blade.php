@extends('layouts.app')

@section('css')
    {{--<link rel="stylesheet" href="css/ej6.style.css">
    <link rel="stylesheet" type="text/css" href="css/progres.css">--}}
@endsection

@section('scripts')

    <script type="text/javascript" src="js/progres.js"></script>
    <script type="text/javascript" src="js/carrusel.js"></script>

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
<section class="scrollProm" id="Scrolling Promos">

    <div class="imag">
        <img class="visible" id="promo1" src="imgs/slim.jpg" alt="slim powerfull laptop">
    </div>
    <div class="imag">
        <img class="oculto" id="promo2" src="imgs/promoSlide.png" alt="slim powerfull laptop">
    </div>
    <div class="imag">
        <img class="oculto" id="promo3" src="imgs/slim.jpg" alt="slim powerfull laptop">
    </div>
    <a class="prev" onclick="anteriorImagen()">&#10094;</a>
    <a class="next" onclick="seguienteImagen()">&#10095;</a>

    <div id="myProgress">
        <div id="myBar">10%</div>
    </div>

</section>
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
