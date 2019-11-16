@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Ver aporte</a></li>
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
                    <div class="card-header bg-dark">Ver aporte Online
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

                                @if ($aporte->ID_TIPO_APORTE==1)
                                    <h1 class="text-center">TITULO: {{$aporte->TITULO}}</h1>
                                    
                                    <h3 class="text-center">{{$aporte->DESCRIPCION}}</h3>
                                    <br>
                                    <h5>{!! substr($aporte->CONTENIDO, 142, -15) !!}</h5>
                                
                                @elseif($aporte->ID_TIPO_APORTE==2)
                                    <h1 class="text-center">TITULO: {{$aporte->TITULO}}</h1>
                                        
                                    <h3 class="text-center">{{$aporte->DESCRIPCION}}</h3>
                                    <br>
                                    <video src="{{ $aporte->CONTENIDO }}" width="640" height="480" muted controls></video>
                                
                                @elseif($aporte->ID_TIPO_APORTE==3)
                                    <h1 class="text-center">TITULO: {{$aporte->TITULO}}</h1>
                                        
                                    <h3 class="text-center">{{$aporte->DESCRIPCION}}</h3>
                                    <br>
                                    <img src="{!! $aporte->CONTENIDO !!}" alt="Logotipo de HTML5" width="auto" height="auto">
                                
                                @else
                                    <h1 class="text-center">TITULO: {{$aporte->TITULO}}</h1>
                                        
                                    <h3 class="text-center">{{$aporte->DESCRIPCION}}</h3>
                                    <br>
                                    <audio class="col-12" src="{{ $aporte->CONTENIDO }}" loop controls></audio>

                                @endif 
                            
                                
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
            // $('#libros').DataTable();
        } );
      


    </script>



@endsection