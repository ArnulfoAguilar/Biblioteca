@extends('layouts.adminLTE')
@section('title')
    Mis Aportes Aprobados
@endsection

@section('Encabezado') 
    Mis aportes aprobados
      
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
   <mis-aportes-aprobados ></mis-aportes-aprobados>
    
@endsection