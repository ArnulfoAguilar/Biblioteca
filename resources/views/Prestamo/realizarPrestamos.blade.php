@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Realizar préstamos</a></li>
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
                    <div class="card-header bg-dark">Listado de libros disponibles
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

                                    {{-- {{$ejemplares->links()}} --}}
                            </div>

                            <table class="table table-hover table-bordered" id="libros">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Autor</th>
                                    <th scope="col">Edición/Tipo</th>
                                    <th scope="col">Disponibles</th>
                                    <th scope="col">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($ejemplares) <= 0 && sizeof($aportes) <=0 )
                                        <tr>
                                            <td>--</td>
                                            <td class="text-center" colspan="4">No Hay material disponible</td>
                                        </tr>
                                    @else
                                        @foreach ($aportes as $aporte)
                                            <tr>
                                                <td>
                                                    --
                                                </td>
                                                <td>{{$aporte->TITULO}}</td>
                                                <td>{{$aporte->usuario->name}}</td>
                                                <td>
                                                    @if ($aporte->ID_TIPO_APORTE==1)
                                                        <i class="fas fa-pen"></i> Escrito
                                                    @elseif($aporte->ID_TIPO_APORTE==2)
                                                        <i class="fas fa-film"></i> Video
                                                    @elseif($aporte->ID_TIPO_APORTE==3)
                                                        <i class="fas fa-palette"></i> Pintura
                                                    @elseif($aporte->ID_TIPO_APORTE==4)
                                                        <i class="fas fa-music"></i> Música
                                                    @else
                                                        <i class="fas fa-question"></i> Desconocido
                                                    @endif 
                                                </td>
                                                <td>&infin;</td>
                                                <td class="text-center">
                                                    <a href="{{route('ver.aporte.online', $aporte)}}">
                                                        <button class="btn btn-sm btn-success" title="Ver Aporte"><i class="fa fa-eye"></i> Ver</button>
                                                    </a>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                        @foreach ($cuentas as $key => $cuenta)
                                            @foreach ($ejemplares as $key2 => $ejemplar)
                                            @if ($key == $key2 && $cuenta > 0)
                                                <tr>    
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$ejemplar->EJEMPLAR}}</td>
                                                    <td>{{$ejemplar->AUTOR}}</td>
                                                    <td>{{$ejemplar->EDICION}}</td>
                                                    <td>
                                                        {{$cuenta}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($penalizado == true)
                                                            <div class="badge bg-red">
                                                                Usted está penalizado
                                                            </div>
                                                        @elseif( $permitido == false )
                                                            <div class="badge bg-red">
                                                                Limite de préstamos alcanzado
                                                            </div>
                                                        @else
                                                            <button type="button" class="btn btn-sm btn-primary" title="Prestar" data-toggle="modal" data-target="#modalSolicitar" 
                                                                data-ejemplar="{{$ejemplar}}" data-disponible="{{$cuenta}}">
                                                                <i class="fa fa-hand-paper"></i> Solicitar
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            {{-- @else
                                                <tr>
                                                <td col="5">
                                                        Posiblemente la cuenta esta en 0
                                                    </td> 
                                                </tr> --}}
                                                
                                            @endif
                                                
                                            @endforeach
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
                                        {{-- {{$ejemplares->links()}} --}}

                                </div>
                               
                            
                                
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSolicitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input class="form-control" type="hidden" id="id_ejemplar" disabled>
                        <div class="form-group col-md-12">
                            <label for="AUTOR">Nombre del libro</label>
                            <input class="form-control" type="text" id="ejemplar" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="AUTOR">Autor/es</label>
                            <input class="form-control" type="text" id="autor" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="AUTOR">Edición</label>
                            <input class="form-control" type="text" id="edicion" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="AUTOR">Editorial</label>
                            <input class="form-control" type="text" id="editorial" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="AUTOR">Cantidad disponible</label>
                            <input class="form-control" type="text" id="disponible" disabled>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="AUTOR">Cantidad a solicitar</label>
                            <input class="form-control" type="number" id="cantidad" min="1" value="1" required {{Auth::user()->rol->id == 2 ? 'disabled' : ''}}>
                        </div>
                        
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cancelar" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary solicitar">Solicitar</button>
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
            $('#libros').DataTable();
        } );
      
        $('#modalSolicitar').on('show.bs.modal', function (event) {
            $('#modalAprobar').focus()
            var button = $(event.relatedTarget)
            var ejemplar = button.data('ejemplar');
            var disponible = button.data('disponible');
            $('.modal-body #ejemplar').val(ejemplar.EJEMPLAR);
            $('.modal-body #id_ejemplar').val(ejemplar.id);
            $('.modal-body #autor').val(ejemplar.AUTOR);
            $('.modal-body #edicion').val(ejemplar.EDICION);
            $('.modal-body #editorial').val(ejemplar.EDITORIAL);
            $('.modal-body #disponible').val(disponible);

        });

        $("#cantidad").change(function(){
            var cantidad = $(this).val();
            var disponible = $('#disponible').val();
            if(cantidad != null && cantidad > 0){
                if(cantidad > disponible){
                    $(this).val(disponible);
                }
            }else{
                $(this).val(disponible);
            }
        });
        $(".solicitar").click(function(){
            $('#modalSolicitar').modal('hide');
            var id = $('#id_ejemplar').val();
            var cantidad = $('#cantidad').val();
            var _token = $('input[name="_token"]').val();
            swal({
                title: "¿Está seguro de solicitar este libro?",
                icon: "warning",
                buttons: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('solicitar.prestamo')}}",
                        method: "POST",
                        data: {
                            id: id,
                            cantidad: cantidad,
                            _token: _token,
                        },
                        success: function (result) {
                            console.log(result)
                            swal({ icon: 'success', title: 'Éxito', text: 'Libro solicitado exitosamente',})
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

        $(".cancelar").click(function(){
            location.reload();
        });


       

    </script>



@endsection


