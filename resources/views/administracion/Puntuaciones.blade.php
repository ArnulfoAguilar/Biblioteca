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
                        <table class="table table-hover table-bordered" id="puntuaciones">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Puntuacion</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Eliminar</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($puntuaciones) <= 0)
                                    <tr>
                                        <td>--</td>
                                        <td class="text-center" colspan="7">No Hay Puntuaciones registradas</td>
                                    </tr>
                                @else
                                    @foreach ($puntuaciones as $puntuacion)
                                        <tr>
                                            <td>{{$puntuacion->id}}</td>
                                            <td>{{$puntuacion->PUNTUACION}}</td>
                                            <td>{{$puntuacion->VALOR}}</td>
                                            <td><button type="button" class="btn btn-block btn-warning">Editar</button></td>
                                            <td> <button type="button" class="btn btn-block btn-danger">Eliminar</button></td>    
                                        </tr>
                                    @endforeach
                                @endif
                               
                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                            
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection
@section('jsExtra')
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

    <script type="text/javascript">
    
        $(document).ready( function () {
            $('#puntuaciones').DataTable();
        } );
        

    </script>

@endsection
