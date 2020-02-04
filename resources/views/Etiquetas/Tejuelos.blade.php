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
    <main class="xs-4">
        <div class="row">
                @foreach($tejuelos as $tejuelo)
                        <div class="col-md-2 justify-content-center">
                            <div class="card text-center">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <p style="max-height: 23px; overflow:hidden">
                                            {{ $tejuelo->ID_PRIMER_SUMARIO}}
                                            {{ $tejuelo->ID_SEGUNDO_SUMARIO}}
                                            {{ $tejuelo->ID_TERCER_SUMARIO}}
                                        </p>
                                       
                                        <p> {{ $tejuelo->ID_BIBLIOTECA }}
                                            {{ $tejuelo->ID_ESTANTE }} 
                                        </p>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                @endforeach
        </div>
        
</main>
@endsection
@section('jsExtra')
    
        <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">  
        <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
        <script type="text/javascript"> 
            $(document).ready( function () {
                window.print();
            } );
        </script>
    
@endsection