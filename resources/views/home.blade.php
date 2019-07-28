@extends('layouts.app_2')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    Usted se ha logeado con exito!
@endsection
