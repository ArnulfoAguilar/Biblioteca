@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Biblioteca</a></li>
    <li class="breadcrumb-item active">Imprimir Codigos de Barra</li>
  </ol>
@endsection
    @section('content')
    <main class="xs-4">
        <div class="row">
            @foreach($tags as $tag)
                    <div class="col-md-4 justify-content-center" >
                        <div class="card text-center">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <p style="max-height: 25px; overflow:hidden">
                                        {{ $tag->EJEMPLAR }}
                                    </p>
                                    <p> 
                                        {!! '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($tag->CODIGO_BARRA, "C128") . '" alt="barcode"   />' !!}
                                    <p> {{ $tag->CODIGO_BARRA }} </p>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
            @endforeach
    </div>
        
</main>

    @endsection
    @section('jsExtra')
    
        <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css" media='screen,print'>
        
        <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
    
        <script type="text/javascript">
        
            $(document).ready( function () {
                window.print();
            } );
    
    
        </script>
    
    @endsection