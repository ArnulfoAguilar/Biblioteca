@extends('layouts.adminLTE')
@section('title')
    Mi Aporte
@endsection

@section('Encabezado')
@switch($id)
    @case(null)
        Mis aportes aprobados
        @break
    @case(0)
        Aportes Pendientes de aprobación
        @break
    @case(1)
        Aportes de la Comunidad Padre Arrupe
        @break
    @default
        
@endswitch
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
   <aportes habilitado="{{$id}}"></aportes>
    
@endsection
