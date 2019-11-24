@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Solvencia de usuarios</a></li>
    <li class="breadcrumb-item active">Biblioteca</li>
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
                    <div class="card-header bg-dark">Solvencia de usuarios
                        <div class=" float-right">
                            {{-- <form class="form-inline" action="{{route('registro.actividad')}}" method="GET">
                                <input type="date" class="form-control mb-2 mr-sm-2" name="fecha_i" placeholder="Desde" value="{{$fecha_i ? $fecha_i : '' }}">
                                <input type="date" class="form-control mb-2 mr-sm-2" name="fecha_f" placeholder="Hasta" value="{{$fecha_f ? $fecha_f : '' }}">
                                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
                            </form> --}}
                        </div>
                    </div>
                    
                    <div class="card-body">
                            <form action="{{route ('biblioteca.ver.solvencia.post')}}">
                                <label for="">Ingrese el nombre de usuario</label>
                                <input id="nombre" name="nombre" class="form-control col-4" type="text" value="{{ isset($busqueda) ? $busqueda : '' }}">
                                <button class="btn btn-success" type="submmit">Buscar</button>
                            </form>

                            @if (isset($users))
                                <br>
                                <table class="table table-hover table-bordered" id="">
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
                                                <td>{{$user->name}}</td>
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
                                                <td></td>
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
            $('#penalizaciones').DataTable();
        } );


    </script>

@endsection