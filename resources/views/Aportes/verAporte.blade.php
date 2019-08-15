@extends('layouts.adminLTE')
@section('cssextra')
<!--ESTE ES PARA SUMMERNOTE

-->
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
                    <div class="card-header"><h1>{{ $aporte->TITULO }}</h1></div>
                    <div class="card-body">
                        {!! $aporte->DESCRIPCION !!}
                    </div>
                </div>
            </div>
        </div>
    </div>    
    
    

@endsection
