@extends('layouts.adminLTE')
@section('title')
    Aportes por área
@endsection

@section('Encabezado') 
    Aportes por área
      
@endsection
@section('breadcrumbs')

@endsection    

@section('content')

<div>
    @if (Auth::user()->ID_COMITE == null)
    <div class="alert alert-danger" role="alert">
        Para ver aportes en esta sección debe de tener asignada un área
      </div>
        
    @endif
</div>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
   <aportes-area ></aportes-area>
    
@endsection