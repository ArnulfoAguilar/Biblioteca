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

                            <table class="table table-hover table-bordered" id="prestamos">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Usuario solicitante</th>
                                    <th scope="col">Ejemplar Solicitado</th>
                                    <th scope="col">Estado del préstamo</th>
                                    <th scope="col">Fecha de devolución esperada</th>
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
                                                @if ($prestamo->FECHA_ESPERADA_DEVOLUCION != null)
                                                    @if ($prestamo->ID_ESTADO_PRESTAMO != 5)
                                                        {{ date('d-m-Y', strtotime($prestamo->FECHA_ESPERADA_DEVOLUCION)) }}
                                                    @else
                                                        --
                                                    @endif
                                                @else
                                                    --
                                                @endif
                                            </td>
                                            <td>
                                                @if ($prestamo->ID_ESTADO_PRESTAMO == 2)
                                                    <button type="button" class="btn btn-sm btn-primary" title="Aprobar" data-toggle="modal" data-target="#modalAprobar" 
                                                    data-prestamo="{{$prestamo->id}}" data-ejemplar="{{$prestamo->EJEMPLAR}}" data-autor="{{$prestamo->AUTOR}}" data-edicion="{{$prestamo->EDICION}}"
                                                    data-fecha1="{{$prestamo->FECHA_PRESTAMO}}" data-fecha2="{{$prestamo->FECHA_DEVOLUCION}}"
                                                    data-adquisicion="{{$prestamo->tipoAdquisicion}}"
                                                    >
                                                    <i class="fas fa-check"></i>
                                                    </button>
                                                @endif

                                                @if ($prestamo->ID_ESTADO_PRESTAMO == 3)
                                                    <button class="btn btn-sm btn-success finalizar" title="Finalizar" data-pres="{{$prestamo->id}}"><i class="fas fa-check-double"></i></button>
                                                    <button class="btn btn-sm btn-warning prorrogar" title="Prorrogar" data-pres="{{$prestamo->id}}"><i class="far fa-clock"></i></button>
                                                @endif

                                                @if ($prestamo->ID_ESTADO_PRESTAMO == 5)
                                                    <button type="button" class="btn btn-sm btn-info" title="Ver detalle" data-toggle="modal" data-target="#modalDetalle" 
                                                    data-prestamo="{{$prestamo->id}}" data-ejemplar="{{$prestamo->EJEMPLAR}}" data-autor="{{$prestamo->AUTOR}}" data-edicion="{{$prestamo->EDICION}}"
                                                    data-fecha1="{{$prestamo->FECHA_PRESTAMO}}" data-fecha2="{{$prestamo->FECHA_DEVOLUCION}}"
                                                    data-adquisicion="{{$prestamo->tipoAdquisicion}}" data-tipo_p="{{$prestamo->tipoPrestamo}}"
                                                    >
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                @endif

                                                @if ($prestamo->ID_ESTADO_PRESTAMO == 6)
                                                    <button class="btn btn-sm btn-success finalizar" title="Finalizar" data-pres="{{$prestamo->id}}"><i class="fas fa-check-double"></i></button>
                                                @endif

                                                @if ($prestamo->ID_ESTADO_PRESTAMO == 7)
                                                    <div class="badge bg-red">Penalizado</div>
                                                @endif

                                                @if ( date('d-m-Y') > date('d-m-Y', strtotime($prestamo->FECHA_ESPERADA_DEVOLUCION)) 
                                                    && $prestamo->ID_ESTADO_PRESTAMO!=5 && $prestamo->ID_ESTADO_PRESTAMO!=7 )
                                                    <button class="btn btn-sm btn-danger penalizar" title="Penalizar" data-pres="{{$prestamo->id}}"><i class="fas fa-ruler"></i></button>
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

    <div class="modal fade" id="modalAprobar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aprobar Préstamo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input class="form-control" type="hidden" id="prestamo" name="prestamo" disabled>
                        <div class="form-group col-md-12">
                            <label for="AUTOR">Nombre del libro</label>
                            <input class="form-control" type="text" id="ejemplar" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="AUTOR">Autor/es</label>
                            <input class="form-control" type="text" id="autor" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="AUTOR">Fecha de préstamo</label>
                            <input class="form-control" type="text" id="fecha1" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="AUTOR">Fecha de devolución</label>
                            <input class="form-control" type="text" id="fecha2" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="AUTOR">Tipo de adquisición</label>
                            <input class="form-control" type="text" id="adquisicion" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="AUTOR">Tipo de préstamo</label>
                            <select class="form-control" id="tipoPrestamo" name="tipoPrestamo">
                                @foreach ($tiposPrestamos as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->TIPO_PRESTAMO}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary aprobar">Aprobar Préstamo</button>
                </div>        
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalle del Préstamo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="ejemplar">Nombre del libro</label>
                            <input class="form-control" type="text" id="ejemplar" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="autor">Autor/es</label>
                            <input class="form-control" type="text" id="autor" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha1">Fecha de préstamo</label>
                            <input class="form-control" type="text" id="fecha1" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha2">Fecha de devolución</label>
                            <input class="form-control" type="text" id="fecha2" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="adquisicion">Tipo de adquisición</label>
                            <input class="form-control" type="text" id="adquisicion" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="tipoPrestamo">Tipo de préstamo</label>
                            <input class="form-control" type="text" id="tipo_p" disabled>
                        </div>
                        
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
            $('#prestamos').DataTable();
        } );

        $('#modalAprobar').on('show.bs.modal', function (event) {
            $('#modalAprobar').focus()
            var button = $(event.relatedTarget)
            // var prestamo = button.data('prestamo')
            $('.modal-body #prestamo').val(button.data('prestamo'));
            $('.modal-body #autor').val(button.data('autor'));
            $('.modal-body #ejemplar').val(button.data('ejemplar'));
            $('.modal-body #fecha1').val(button.data('fecha1'));
            $('.modal-body #fecha2').val(button.data('fecha2'));
            $('.modal-body #adquisicion').val(button.data('adquisicion'));
        });

        $('#modalDetalle').on('show.bs.modal', function (event) {
            $('#modalDetalle').focus()
            var button = $(event.relatedTarget)
            // var prestamo = button.data('prestamo')
            $('.modal-body #autor').val(button.data('autor'));
            $('.modal-body #ejemplar').val(button.data('ejemplar'));
            $('.modal-body #fecha1').val(button.data('fecha1'));
            $('.modal-body #fecha2').val(button.data('fecha2'));
            $('.modal-body #adquisicion').val(button.data('adquisicion'));
            $('.modal-body #tipo_p').val(button.data('tipo_p'));
        });

        $(".aprobar").click(function(){
            $('#modalAprobar').modal('hide');

            var id = $('#prestamo').val();
            var tipoPrestamo = $('#tipoPrestamo').val();
            var _token = $('input[name="_token"]').val();

            swal({
                title: "¿Esta seguro de aprobar este prestamo?",
                icon: "warning",
                buttons: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('aprobar.prestamo')}}",
                        method: "POST",
                        data: {
                            id: id,
                            tipoPrestamo: tipoPrestamo,
                            _token: _token,
                        },
                        success: function (result) {
                            swal({ icon: 'success', title: 'Éxito', text: 'Préstamo aprobado exitosamente',})
                            .then((value) => {
                                location.reload();
                            });
                        },
                        error: function (result) {
                            swal({ icon: 'error', title: 'Error', text: 'Intente de nuevo. Si eso no funciona contacte al administrador',})
                            .then((value) => {
                                location.reload();
                            });
                        },
                    })
                } else {
                    location.reload();
                }
            });

        });

        $(".finalizar").click(function(){
            var id = $(this).data('pres');
            var _token = $('input[name="_token"]').val();

            swal({
                title: "¿Está seguro de finalizar este préstamo?",
                text: "El libro se marcará como disponible, y estará visible para futuros préstamos",
                icon: "warning",
                buttons: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('finalizar.prestamo')}}",
                        method: "POST",
                        data: {
                            id: id,
                            _token: _token,
                        },
                        success: function (result) {
                            swal({ icon: 'success', title: 'Éxito', text: 'Préstamo finalizado exitosamente',})
                            .then((value) => {
                                location.reload();
                            });
                        },
                        error: function (result) {
                            swal({ icon: 'error', title: 'Error', text: 'Intente de nuevo. Si eso no funciona contacte al administrador',})
                            .then((value) => {
                                location.reload();
                            });
                        },
                    })
                } else {
                    location.reload();
                }
            });

        });


        $(".prorrogar").click(function(){
            var id = $(this).data('pres');
            var _token = $('input[name="_token"]').val();

            swal({
                title: "¿Está seguro de prorrogar este préstamo?",
                icon: "warning",
                buttons: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('prorrogar.prestamo')}}",
                        method: "POST",
                        data: {
                            id: id,
                            _token: _token,
                        },
                        success: function (result) {
                            swal({ icon: 'success', title: 'Éxito', text: 'Préstamo prorrogado exitosamente',})
                            .then((value) => {
                                location.reload();
                            });
                        },
                        error: function (result) {
                            swal({ icon: 'error', title: 'Error', text: 'Intente de nuevo. Si eso no funciona contacte al administrador',})
                            .then((value) => {
                                location.reload();
                            });
                        },
                    })
                } else {
                    location.reload();
                }
            });

        });

        $(".penalizar").click(function(){
            var id = $(this).data('pres');
            var _token = $('input[name="_token"]').val();

            swal({
                title: "¿Está seguro de penalizar al usuario relacionado a este préstamo?",
                icon: "warning",
                buttons: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('penalizar.prestamo')}}",
                        method: "POST",
                        data: {
                            id: id,
                            _token: _token,
                        },
                        success: function (result) {
                            swal({ icon: 'success', title: 'Éxito', text: 'Penalización creada exitosamente. Puede ver las penalizaciones en el panel respectivo',})
                            .then((value) => {
                                location.reload();
                            });
                        },
                        error: function (result) {
                            swal({ icon: 'error', title: 'Error', text: 'Intente de nuevo. Si eso no funciona contacte al administrador',})
                            .then((value) => {
                                location.reload();
                            });
                        },
                    })
                } else {
                    location.reload();
                }
            });

        });

    </script>



@endsection