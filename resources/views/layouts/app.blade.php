<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @yield('meta')
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf-token">

    <meta name="src-imgs" content="{{ asset('img') }}">

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
    @yield('scripts')


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/mainlayout.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    @include('nav.navbar')
    <main>
        @yield('content')
    </main>
</body>
    @include('footer')
</html>
