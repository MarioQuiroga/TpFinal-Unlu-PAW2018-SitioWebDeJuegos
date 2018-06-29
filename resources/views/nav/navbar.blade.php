<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<nav class="navbar">
    <div class="logo">
        <a class="" href="{{ url('/') }}">
            <img class="logo" src="{{asset('img/KiwiLogo.png')}}" alt="">
        </a>
    </div>
    <div class="logo">
        <h2>KiwiJuegos</h2>
    </div>
        {{-- TODO Hacer navbar escondible--}}
    <div class='nav-ul'>
        <ul class="">
            <!-- Authentication -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>


</nav>


