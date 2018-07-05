@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/index/carrusel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/index/index.css')}}">
@endsection

@section('scripts')
        <script type="text/javascript" src="{{asset('js/index/carrusel.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/index/buscadorJuegos.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Carrusel.init();
            BuscadorJuegos.init();
        });

    </script>
@endsection

@section('meta')
    <meta charset="UTF-8">
    <title>KiwiJuegos</title>
    <meta name="author" content="Bruno Crisafulli y Mario Quiroga">
@endsection
{{---- Contenido ----}}
@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

{{--///// Juegos featured /////--}}
<section class="carrusel">

    {{--<a class="prev" onclick="Carrusel.mover(-1)">&#10094;</a>--}}

    <div class="carrusel-imgs" id="carrusel-imgs" data-track="hover">
        @foreach($featured as $feat)
            <div class="feat-game fade">
                <a href="">
                    <img src="{{asset('img/'. $feat->nombre_server . '/'. $feat->featImage)}}" alt="{{$feat->titulo}}">
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

{{--///// Juegos Mejor Rankeados /////--}}
<div class="section-title">
    <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cGF0aCBzdHlsZT0iZmlsbDojRkY2NTM2OyIgZD0iTTU0LjIxMSwyNDkuN2MwLDAsMjAuMjI4LDI5LjcxNyw2Mi42MjQsNTQuODcxYzAsMC0zMC43MDUtMjU5LjUwMiwxNjkuMzU4LTMwNC41NzEgIGMtNTEuMjU3LDE4OC4xMjEsNjUuMiwyNDEuMTc0LDEwNy42NTEsMTQxLjc4NmM3MC44OTMsOTQuNjUxLDE3LjA2NiwxNzcuMjI5LDE3LjA2NiwxNzcuMjI5ICBjMjkuMDY5LDQuMTg4LDUzLjQ4Ny0yNy41Nyw1My40ODctMjcuNTdjMC4yMTgsMy45MTIsMC4zNCw3Ljg1MSwwLjM0LDExLjgxOEM0NjQuNzM4LDQxOC41NDUsMzcxLjI4Myw1MTIsMjU2LDUxMiAgUzQ3LjI2Miw0MTguNTQ1LDQ3LjI2MiwzMDMuMjYyQzQ3LjI2MiwyODQuNzQ0LDQ5LjY4NiwyNjYuNzk0LDU0LjIxMSwyNDkuN3oiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0ZGNDIxRDsiIGQ9Ik00NjQuMzk4LDI5MS40NDVjMCwwLTI0LjQxOCwzMS43NTgtNTMuNDg3LDI3LjU3YzAsMCw1My44MjctODIuNTc4LTE3LjA2Ni0xNzcuMjI5ICBDMzUxLjM5NCwyNDEuMTc0LDIzNC45MzcsMTg4LjEyMSwyODYuMTk0LDBDMjc1LjQ3OSwyLjQxNCwyNjUuNDMxLDUuNDQ3LDI1Niw5LjAxOFY1MTJjMTE1LjI4MywwLDIwOC43MzgtOTMuNDU1LDIwOC43MzgtMjA4LjczOCAgQzQ2NC43MzgsMjk5LjI5NSw0NjQuNjE2LDI5NS4zNTcsNDY0LjM5OCwyOTEuNDQ1eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRkJCRjAwOyIgZD0iTTE2NC40NTYsNDIwLjQ1NkMxNjQuNDU2LDQ3MS4wMTQsMjA1LjQ0Miw1MTIsMjU2LDUxMnM5MS41NDQtNDAuOTg2LDkxLjU0NC05MS41NDQgIGMwLTI3LjA2MS0xMS43NDEtNTEuMzc5LTMwLjQwOC02OC4xMzhjLTM1LjM5NCw0OC4wODUtODUuODMyLTI0Ljg1Ni00Ni41MjQtNzguMTIyICBDMjcwLjYxMiwyNzQuMTk2LDE2NC40NTYsMjg3LjQ5OSwxNjQuNDU2LDQyMC40NTZ6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRkE5MDA7IiBkPSJNMzQ3LjU0NCw0MjAuNDU2YzAtMjcuMDYxLTExLjc0MS01MS4zNzktMzAuNDA4LTY4LjEzOGMtMzUuMzk0LDQ4LjA4NS04NS44MzItMjQuODU2LTQ2LjUyNC03OC4xMjIgIGMwLDAtNS43NjgsMC43MjUtMTQuNjEyLDMuNTE2VjUxMkMzMDYuNTU4LDUxMiwzNDcuNTQ0LDQ3MS4wMTQsMzQ3LjU0NCw0MjAuNDU2eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" />
    <h2>Hot Games</h2>
    <a class='minor-link' href="#juegos-todos">(Ver todos)</a>
</div>

<section class="hot-games">


    <div class="games-mosaico">
    @foreach($hots as $game)
        <div class="game-box">
            <div class="game-box-img">
                <img src="{{asset('img/'. $game->nombre_server . '/'. $game->avatar)}}" alt="{{$game->titulo}}">
            </div>
            <p>
                <b>{{$game->titulo}}</b>
            </p>
            <span class="valoracion">&#11088 {{ $game->valoracion_promedio }}</span>
            <div class="tags">
                @foreach($game->tags() as $tag)
                    <span class="tag">{{$tag->nombre}}</span>
                @endforeach
            </div>
        </div>
    @endforeach
    </div>
</section>
<a name="juegos-todos"></a>
@include('utils.separador')

{{--///// Buscador de Juegos /////--}}
<h2>Todos los Juegos</h2>
<section class="buscador-juegos">
    <div class="panel-control">
        <ul>
            <li>
                <input type="text" placeholder="buscar..." name="search" id="searchGame" onkeydown="BuscadorJuegos.buscar(this)">
            </li>
            @foreach($mainTags as $tag)
                <li>
                    <span class="tagFilter" onclick="BuscadorJuegos.tagFilter({{$tag->nombre}})">{{$tag->nombre}}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="games-mosaico" id="mosaico-buscador">
        @foreach($juegos as $game)
            <div class="game-box">
                <div class="game-box-img">
                    <img src="{{asset('img/'. $game->nombre_server . '/'. $game->avatar)}}" alt="{{$game->titulo}}">
                </div>
                <p>
                    <b>{{$game->titulo}}</b>
                </p>
                <span class="valoracion">&#11088 {{ $game->valoracion_promedio }}</span>
                <div class="tags">
                    @foreach($game->tags() as $tag)
                        <span class="tag">{{$tag->nombre}}</span>
                    @endforeach
                </div>
            </div>
        @endforeach
      
    </div>
</section>
@include('utils.separador')
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
