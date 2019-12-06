@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Imprimir codigos de barra</a></li>
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
                           <a href="{{ route('imprimir.all') }}" class="btn btn-sm btn-primary">Imprimir todos los ejemplares</a>
                           <a href="{{ route('imprimir.tejuelos') }}" class="btn btn-sm btn-primary">Imprimir todos los tejuelos</a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                            <div class="d-flex justify-content-center">
                              {{$ejemplares->links()}}
                            </div>

                            <table class="table table-hover table-bordered" id="libros">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Autor</th>
                                    <th scope="col">Acciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(sizeof($ejemplares) <= 0 ) )
                                        <tr>
                                            <td>--</td>
                                            <td class="text-center" colspan="4">No Hay libros disponibles</td>
                                        </tr>
                                    @else
                                    @foreach ($ejemplares as $key2 => $ejemplar)
                                        <tr>    
                                            <td>{{$ejemplar->EJEMPLAR}}</td>
                                            <td>{{$ejemplar->AUTOR}}</td>
                                            <td>{{$ejemplar->EDICION}}</td>
                                            <td class="text-center">
                                                
                           <a href="{{ route('imprimir.Ejemplar', ['ejemplar' => $ejemplar->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-hand-paper"></i><br>Imprimir ejemplar</a>
                                                   
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
      
    </script>



@endsection


