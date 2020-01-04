@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Listado de prestamos</a></li>
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
                    <div class="card-header bg-dark">Listado de prestamos
                        <div class=" float-right">
                        </div>
                    </div>
                    
                    <div class="card-body">
                            <div class="d-flex justify-content-center">
                                {{-- {{$registros->appends([
                                    'fecha_i' => $fecha_i,
                                    'fecha_f' => $fecha_f
                                    ])->links()}} --}}

                                    {{-- {{$prestamos->links()}} --}}
                            </div>

                            <table class="table table-hover table-bordered" id="prestamos">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ejemplar</th>
                                    <th scope="col">Autor</th>
                                    <th scope="col">Biblioteca</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Fecha de préstamo</th>
                                    <th scope="col">Fecha de devolución</th>
                                    <th scope="col">Estado</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($prestamos) <= 0)
                                        <tr>
                                            <td>--</td>
                                            <td class="text-center" colspan="7">No Hay Prestamos Realizados</td>
                                        </tr>
                                    @else
                                        @foreach ($prestamos as $prestamo)
                                            <tr>
                                                <td>{{$prestamo->id}}</td>
                                                <td>
                                                    @foreach ($prestamo->materiales as $material)
                                                        <div> {{$material->ejemplar->EJEMPLAR}}</div>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($prestamo->materiales as $material)
                                                        <div> {{$material->ejemplar->AUTOR}}</div>
                                                    @endforeach
                                                </td>
                                                <td>--</td>
                                                <td>{{ $prestamo->tipoPrestamo != null ? $prestamo->tipoPrestamo->TIPO_PRESTAMO : 'Sin especificar' }}</td>
                                                <td>{{ $prestamo->FECHA_PRESTAMO != null ? date('d-m-Y', strtotime($prestamo->FECHA_PRESTAMO)) : 'Sin fecha' }}</td>
                                                <td>{{ $prestamo->FECHA_DEVOLUCION != null ? date('d-m-Y', strtotime($prestamo->FECHA_DEVOLUCION)) : 'Sin fecha' }}</td>
                                                <td>
                                                    @switch($prestamo->estadoPrestamo->id)
                                                        @case(1)
                                                            <div class="badge bg-info">{{$prestamo->estadoPrestamo->ESTADO_PRESTAMO}}</div>
                                                            @break
                                                        @case(2)
                                                            <div class="badge bg-primary">{{$prestamo->estadoPrestamo->ESTADO_PRESTAMO}}</div>
                                                        @break
                                                        @case(3)
                                                            <div class="badge bg-warning">{{$prestamo->estadoPrestamo->ESTADO_PRESTAMO}}</div>
                                                            @break
                                                        @case(4)
                                                            <div class="badge bg-warning">{{$prestamo->estadoPrestamo->ESTADO_PRESTAMO}}</div>
                                                            @break
                                                        @case(5)
                                                            <div class="badge bg-success">{{$prestamo->estadoPrestamo->ESTADO_PRESTAMO}}</div>
                                                            @break
                                                        @case(6)
                                                            <div class="badge bg-warning">{{$prestamo->estadoPrestamo->ESTADO_PRESTAMO}}</div>
                                                            @break
                                                        @case(7)
                                                            <div class="badge bg-danger">{{$prestamo->estadoPrestamo->ESTADO_PRESTAMO}}</div>
                                                            @break
                                                        @case(8)
                                                            <div class="badge bg-danger">{{$prestamo->estadoPrestamo->ESTADO_PRESTAMO}}</div>
                                                            @break
                                                        @default
                                                            
                                                    @endswitch
                                                </td>
                                            
                                            </tr>
                                        @endforeach
                                    @endif
                                   
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                                
                              </table>
                              
                              <div class="d-flex justify-content-center">
                                    {{-- {{$registros->appends([
                                        'fecha_i' => $fecha_i,
                                        'fecha_f' => $fecha_f
                                        ])->links()}} --}}
                                        {{-- {{$prestamos->links()}} --}}

                                </div>
                               
                            
                                
                            <div class="modal-footer">
                                
                            </div>
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
            $('#prestamos').DataTable({
                "order": [[ 0, "desc" ]]
            });
        } );

    </script>

@endsection