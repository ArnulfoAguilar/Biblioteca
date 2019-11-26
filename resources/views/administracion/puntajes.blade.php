@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Puntajes de usuarios</a></li>
    <li class="breadcrumb-item active">Administración</li>
  </ol>
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
                    <div class="card-header bg-dark">Puntajes de usuarios
                        <div class=" float-right">
                            {{-- <form class="form-inline" action="{{route('registro.actividad')}}" method="GET">
                                <input type="date" class="form-control mb-2 mr-sm-2" name="fecha_i" placeholder="Desde" value="{{$fecha_i ? $fecha_i : '' }}">
                                <input type="date" class="form-control mb-2 mr-sm-2" name="fecha_f" placeholder="Hasta" value="{{$fecha_f ? $fecha_f : '' }}">
                                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
                            </form> --}}
                        </div>
                    </div>
                    
                    <div class="card-body">
                            <form class="form-inline" action="{{route ('biblioteca.ver.solvencia.post')}}">
                                    <input id="nombre" name="nombre" class="form-control mr-sm-2 col-6" type="search" placeholder="-- Nombre de usuario --" aria-label="Search" value="{{ isset($busqueda) ? $busqueda : '' }}">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                            </form>
                            

                            @if (isset($users))
                                <br>
                                <table class="table table-hover table-bordered" id="solvencias">
                                    <thead>
                                        <tr>
                                            <th>Numero</th>
                                            <th>Usuario</th>
                                            <th>Estado</th>
                                            <th>Detalle</th>
                                            <th>Acciones</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$user->name}} {{$user->apellidos}}</td>
                                                <td>    
                                                    @if (array_sum($cuentas[$key]) == 0)
                                                       <div class="badge bg-success">SOLVENTE</div>
                                                    @else
                                                        <div class="badge bg-danger">INSOLVENTE</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $texto='';
                                                    @endphp

                                                    @if ($cuentas[$key][0] != 0)
                                                       <div>Ha prestado material</div>
                                                    @elseif($cuentas[$key][1] != 0)
                                                        <div>Material pendiente de devolución</div>
                                                    @elseif($cuentas[$key][2] != 0)
                                                        <div>Prestamo prorrogado</div>
                                                    @elseif($cuentas[$key][3] != 0)
                                                        <div>Ha sido penalizado</div>
                                                    @else
                                                        <div>--</div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if (array_sum($cuentas[$key]) == 0)
                                                        <a href="{{route('biblioteca.extender.solvencia', ['id' =>$user->id])}}" target="_blank">
                                                            <button type="button" class="btn btn-sm btn-success" title="Imprimir">
                                                                <i class="fas fa-print"></i>
                                                            </button>
                                                        </a>
                                                    @else
                                                        <div class="badge bg-danger">INSOLVENTE</div>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        
                    </div>
                </div>

               
                
            </div>
        </div>
    </div>

@endsection
@section('jsExtra')

    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

    <script type="text/javascript">
    
        $(document).ready( function () {
            $('#solvencias').DataTable();
        } );


    </script>

@endsection