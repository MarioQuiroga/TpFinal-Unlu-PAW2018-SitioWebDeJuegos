@extends('layouts.app')

@section('content')
<h2>Dashboard</h2>
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

You are logged in!
@endsection
