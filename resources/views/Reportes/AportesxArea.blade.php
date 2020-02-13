@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Estadisticas de aportes</a></li>
    <li class="breadcrumb-item active">Biblioteca</li>
  </ol>
@endsection
    @section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div id="titulo" class="row" >
        <div class="col-md-2"></div>
        <div height="100px" class="col-md-2 ">
            <img height="150px" src="/iconos/arrupe_logo.png" alt="Logo Padre Arrupe">
        </div>
        <div class="col-md-6 text-left" style="font-size:19pt;">
            <p>
                <b>
                    <br>
                    <span>COLEGIO ESPAÑOL PADRE ARRUPE</span>
                    <br>
                    <span>Aportes por area</span>
                    <br>
                </b>
            </p>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark">Lista Aportes por area
                        <div class=" float-right">
                        </div>
                    </div>
                    
                    <div class="card-body">
                                <br>
                                @if ($AportesxArea->count() > 0)
                                <table class="table table-hover table-bordered" id="">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cantidad</th>
                                            <th>Area</th>

                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        
                                      
                                            
                                        @foreach ($AportesxArea as $key => $Aporte)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$Aporte->count}}</td>
                                            <td>    
                                                {{$Aporte->AREA}}
                                            </td>
                                            
                                        </tr>
                                    
                                    </tbody>
                                </table>
                                @endforeach
                                    
                                    @else
                                    <h3>Todos los libros están inventariados</h3>        
                                    @endif
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
                $('#penalizaciones').DataTable();
                window.print();
            } );
    
    
        </script>
    
    @endsection





