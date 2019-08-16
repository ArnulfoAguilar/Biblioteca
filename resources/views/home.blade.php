@extends('layouts.adminLTE')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h2 class="text-center">¡ Bienvenido a la principal !</h2>
    <lista-ejem-table></lista-ejem-table>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endsection
