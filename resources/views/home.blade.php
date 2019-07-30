@extends('layouts.app_2')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ¡ Bienvenido a la pagina principal !
                    <br><br>
                    <a href="{{ route('busqueda') }}" class="btn btn-success col-md-6">Ingresar libros</a>
                    <br>
                    <a href="{{ route('lista.ejemplares') }}" class="btn btn-success col-md-6">Lista de libros</a>
                </div>
            </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}

        </div>
    @endif
@endsection
