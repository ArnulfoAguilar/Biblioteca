@extends('layouts.adminLTE')
@section('title')
    Mi Aporte
@endsection

@section('Encabezado')
Aportes de la Comunidad Padre Arrupe
@endsection
@section('breadcrumbs')
<div class="float-right">
    <a class="btn btn-app" href="{{ route('aportes.create')}}">
        <i class="far fa-plus-square"></i> Nuevo Aporte
    </a>
</div>
@endsection    

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
   <aportes></aportes>
    
@endsection
