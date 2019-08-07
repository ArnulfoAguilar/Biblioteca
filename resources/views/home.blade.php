@extends('layouts.adminLTE')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h2 class="col-md-12">¡ Bienvenido a la pagina principal !</h2>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}

        </div>
    @endif
@endsection
