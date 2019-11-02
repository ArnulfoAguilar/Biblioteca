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

                                    {{$prestamos->links()}}
                            </div>

                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Usuario solicitante</th>
                                    <th scope="col">Ejemplar Solicitado</th>
                                    <th scope="col">Estado del prestamo</th>
                                    <th scope="col">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($prestamos) <= 0)
                                        <tr>
                                            <td>--</td>
                                            <td class="text-center" colspan="4">No Hay Prestamos Realizados</td>
                                        </tr>
                                    @else
                                        @foreach ($prestamos as $prestamo)
                                            <tr>
                                            <td>{{$prestamo->id}}</td>
                                            <td>{{$prestamo->name}}</td>
                                            <td>{{$prestamo->EJEMPLAR}}</td>
                                            <td>{{$prestamo->ESTADO_PRESTAMO}}</td>
                                            <td>
                                                @if ($prestamo->ID_ESTADO_PRESTAMO == 2)
                                                    <button class="btn btn-sm btn-primary aprobar" title="Aprobar" data-pres="{{$prestamo->id}}"><i class="fas fa-check"></i></button>
                                                @endif

                                                @if ($prestamo->ID_ESTADO_PRESTAMO == 3)
                                                    <button class="btn btn-sm btn-success finalizar" title="Finalizar" data-pres="{{$prestamo->id}}"><i class="fas fa-check-double"></i></button>
                                                @endif
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
                                        {{$prestamos->links()}}

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
        $('.aprobar').click(function () {
            var id = $(this).data('pres')
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('aprobar.prestamo')}}",
                method: "POST",
                data: {
                    id: id,
                    _token: _token,
                },
                success: function (result) {
                    swal({ type: 'success', title: 'Exito', text: 'Aporte aprobado con exito',})
                },
                error: function (result) {
                    swal({ type: 'error', title: 'Oops...', text: 'Error',})
                },

            })
        });
    </script>



@endsection