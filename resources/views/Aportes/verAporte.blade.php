@extends('layouts.adminLTE')
@section('title')
    Mi Aporte
@endsection
@section('cssextra')
<!--ESTE ES PARA SUMMERNOTE

-->
@endsection
@section('Encabezado')
    <a class="btn btn-app" href="{{ route('aportes.edit', $aporte->id)}}">
        <i class="fas fa-edit"></i> Edit
    </a>
@endsection
@section('breadcrumbs')
<div class="float-right">
        Creado el: {{ $aporte->created_at }}
</div>
@endsection    

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
    <div class="container">    
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color:#343A40!important; color:white!important;">
                        <h1>{{ $aporte->TITULO }}</h1>
                    </div>
                    <div class="card-body">
                        {!! $aporte->DESCRIPCION !!}
                    </div>
                    
                </div>
                {{-- <div class="card">
                    <div class="card-header bg-dark">
                        <h3>Revisiones</h3>
                    </div>
                    <div class="card-body">
                        <revisiones aporte="{{$aporte->id}}" area="{{$aporte->ID_AREA}}" rol="{{Auth::user()->ID_ROL}}" usuario="{{Auth::user()->id}}"></revisiones>
                    </div>
                </div> --}}
                <revisiones aporte="{{$aporte->id}}" area="{{$aporte->ID_AREA}}" rol="{{Auth::user()->ID_ROL}}" usuario="{{Auth::user()->id}}"></revisiones>

            </div>
        </div>
    </div>    
    
    

@endsection
