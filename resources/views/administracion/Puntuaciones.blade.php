@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
    <li class="breadcrumb-item active">Variables Globales</li>
  </ol>
@endsection

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color:#343A40!important; color:white!important;">Puntuaciones</div>
                    
                        @if(!empty($errors->all()))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Alerta</h5>
                                <div class="">
                                    <h4 class="col-md-4">Por favor, valida los siguientes errores:</h4>
                                    <ul>
                                    @foreach ($errors->all() as $mensaje)
                                        <li>
                                            {{$mensaje}}
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>

                            </div>
                        @endif
                    <div class="card-body">
                        <p>Puntuaciones con Datatable con la variable $puntuaciones</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('jsExtra')

@endsection
