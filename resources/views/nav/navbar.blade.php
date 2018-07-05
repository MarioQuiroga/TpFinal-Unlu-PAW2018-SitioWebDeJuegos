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
    <div class='ul-right-nav'>
        <ul class="nav-ul">
            <!-- Authentication -->
            @php
                $user=Auth::guard('api')->user();
            @endphp
            @if($user==null)
                <li>
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item dropdown">

                    <a class="nav-link" href="{{ url('user/'.Auth::user()->id) }}" role="button">

                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu">
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
            @endif
        </ul>
    </div>
</nav>


