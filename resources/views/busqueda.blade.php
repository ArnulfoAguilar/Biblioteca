@extends('layouts.app')

@section('content')
    <busqueda-api></busqueda-api>
    <a href="{{route('home')}}">
        <button class="btn btn-secondary">Regresar</button>
    </a>
@endsection