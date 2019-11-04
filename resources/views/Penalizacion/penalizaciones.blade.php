@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Listado de penalizaciones</a></li>
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
                    <div class="card-header bg-dark">Listado de penalizaciones
                        <div class=" float-right">
                            {{-- <form class="form-inline" action="{{route('registro.actividad')}}" method="GET">
                                <input type="date" class="form-control mb-2 mr-sm-2" name="fecha_i" placeholder="Desde" value="{{$fecha_i ? $fecha_i : '' }}">
                                <input type="date" class="form-control mb-2 mr-sm-2" name="fecha_f" placeholder="Hasta" value="{{$fecha_f ? $fecha_f : '' }}">
                                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
                            </form> --}}
                        </div>
                    </div>
                    
                    <div class="card-body">
                            <div class="d-flex justify-content-center">
                                {{-- {{$registros->appends([
                                    'fecha_i' => $fecha_i,
                                    'fecha_f' => $fecha_f
                                    ])->links()}} --}}

                                    {{$penalizaciones->links()}}
                            </div>

                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Usuario reportado</th>
                                    <th scope="col">Préstamo involucrado</th>
                                    <th scope="col">Material implícito</th>
                                    <th scope="col">Número de copia</th>
                                    <th scope="col">Fecha de devolución esperada</th>
                                    <th scope="col">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($penalizaciones) <= 0)
                                        <tr>
                                            <td>--</td>
                                            <td class="text-center" colspan="4">No Hay Penalizaciones Realizadas</td>
                                        </tr>
                                    @else
                                        @foreach ($penalizaciones as $penalizacion)
                                            <tr>
                                                <td>{{$penalizacion->id}}</td>
                                                <td>{{$penalizacion->prestamo->usuario->name}}</td>
                                                <td>{{$penalizacion->prestamo->id}}</td>
                                                <td>{{$penalizacion->prestamo->material->ejemplar->EJEMPLAR}}</td>
                                                <td>{{$penalizacion->prestamo->material->COPIA_NUMERO}}</td>
                                                <td>{{ date('d-m-Y', strtotime( $penalizacion->prestamo->FECHA_ESPERADA_DEVOLUCION )) }}</td>
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
                                        {{$penalizaciones->links()}}

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

    <script type="text/javascript">

    </script>



@endsection