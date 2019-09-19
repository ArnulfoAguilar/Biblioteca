@extends('layouts.adminLTE')
@section('title')
    Mi Aporte
@endsection

@section('Encabezado')
Todos los aportes
@endsection
@section('breadcrumbs')
{{-- <div class="float-right">
    <a class="btn btn-primary" href="{{ route('aportes.create')}}">
        <i class="far fa-plus-square"></i> Nuevo Aporte
    </a>
</div> --}}
@endsection    

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
   {{-- <aportes-director></aportes-director> --}}
   {{-- <aportes-director></aportes-director> --}}
   <aportes-director></aportes-director>
    
@endsection
