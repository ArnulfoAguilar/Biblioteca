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

                                    {{$ejemplares->links()}}
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
                                    @if(sizeof($ejemplares) <= 0 && sizeof($aportes) )
                                        <tr>
                                            <td>--</td>
                                            <td class="text-center" colspan="4">No Hay libros disponibles</td>
                                        </tr>
                                    @else
                                        @foreach ($aportes as $aporte)
                                            <tr>
                                                <td>--</td>
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
                                                                Usted esta penalizado
                                                            </div>
                                                        @else
                                                            <button class="btn btn-sm btn-success solicitar" title="Solicitar" data-ejem="{{$ejemplar->id}}"><i class="fa fa-hand-paper"></i> Solicitar</button>
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
                                        {{$ejemplares->links()}}

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
            $('#libros').DataTable();
        } );
      

        $(".solicitar").click(function(){
            var id = $(this).data('ejem');
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
       

    </script>



@endsection