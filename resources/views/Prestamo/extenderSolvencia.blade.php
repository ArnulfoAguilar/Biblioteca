@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection



@section('content')
   
<div class="align-middle" style="max-width: 100%; min-width: 100%;">
 
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
                        <span>SOLVENCIA DE BIBLIOTECA</span>
                        <br>
                    </b>
                </p>
            </div>
        </div>
        
        <br>
        
        <div class="" id="contenido_de_impresion" style="max-width: 100%; min-width: 100%; font-size:14pt;">
        
            <div class="row align-middle">

                    
                    <div class="col-12">
                        FECHA: {{date('d-m-Y')}}
                        <br>
                        <br>
                        POR MEDIO DE LA PRESENTE CERTIFICO QUE <strong>{{ strtoupper($user->name) }} {{strtoupper($user->apellidos) }}</strong>
                        
                        ESTÁ SOLVENTE CON LA BIBLIOTECA DEL COLEGIO. SE EXTIENDE LA PRESENTE EN ESTA CIUDAD PARA LOS USOS QUE EL INTERESADO ESTIME CONVENIENTE
                        <br>
                        <br>
                    </div>
                    <div class="col-12 text-center">
                        _____________________________
                        <br>
                        RENÉ G. ABARCA
                        <br>
                        ENCARGADO Y ADMINISTRADOR DE BIBLIOTECAS


                    </div>

            </div>
                        <br>                
        </div>
        <div class="m-0" style="max-width: 100%; min-width: 100%;">
        
            <div class="col-md-12 text-right m-0" style="font-size:8pt;">
                <p>
                    <span>Solvencia de biblioteca generada por el Sistema de BIblioteca Online Arrupe</span>
                    <br>
                    <strong>{{ ucfirst(strftime( "%A %d de %B de %Y %R"))}}</strong>
                </p>
            </div>
        
        </div>
    </div>
-------------------------------------------------------------------------------------------------------------------------------------------------------------
@endsection
@section('jsExtra')

    <script type="text/javascript">
    
        $(document).ready( function () {
            window.print();
        } );


    </script>

@endsection






     
