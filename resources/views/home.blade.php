@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    You are logged in!
    <br><br>
    <a href="{{ route('busqueda') }}" class="btn btn-info">Ir al modulo de busqueda de libros</a>
    <br><br>
    <a href="{{ route('lista.ejemplares') }}" class="btn btn-success">Ir al modulo de lista de libros</a>
@endsection
