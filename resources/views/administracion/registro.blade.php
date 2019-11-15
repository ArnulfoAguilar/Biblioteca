@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
    <li class="breadcrumb-item active">Registro de actividades</li>
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
                    <div class="card-header bg-dark">Registro de actividades
                        <div class=" float-right">
                            <form class="form-inline" action="{{route('registro.actividad')}}" method="GET">
                                <input type="date" class="form-control mb-2 mr-sm-2" name="fecha_i" placeholder="Desde" value="{{$fecha_i ? $fecha_i : '' }}">
                                <input type="date" class="form-control mb-2 mr-sm-2" name="fecha_f" placeholder="Hasta" value="{{$fecha_f ? $fecha_f : '' }}">
                                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        {{-- <form  action="#" method="POST" enctype="multipart/form-data"> --}}
                            {{ csrf_field() }}

                            <div class="d-flex justify-content-center">
                                {{$registros->appends([
                                    'fecha_i' => $fecha_i,
                                    'fecha_f' => $fecha_f
                                    ])->links()}}
                            </div>

                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Accion Realizada</th>
                                    {{-- <th scope="col">Realizada en </th> --}}
                                    <th scope="col">Fecha</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros as $key => $registro)
                                        <tr>
                                            
                                            {{-- <th scope="row">{{$key+1}}</th> --}}
                                            <th scope="row">{{$registro->id}}</th>
                                            @php
                                                $found=false;
                                            @endphp

                                            @foreach ($users as $user)
                                                @if ($user->id == $registro->causer_id)
                                                    <td>{{$user->name}}</td>
                                                    @php
                                                        $found = true;
                                                    @endphp
                                                @endif
                                            @endforeach

                                            @if ($found == false)
                                                <td> << Usuario no encontrado >> </td>
                                            @endif
                                            <td>
                                                {{$registro->description}}
                                                
                                                @if ($registro->subject_id != null)
                                                    @if ($registro->subject_type == 'App\Aporte')
                                                        <a href="/aportes/{{$registro->subject_id}}" title="Ir">
                                                            <i class="fas fa-external-link-alt"></i>
                                                        </a>
                                                    @endif
                                                    
                                                @endif
                                            </td>
                                            <td>{{$registro->created_at}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                                
                              </table>
                              
                              <div class="d-flex justify-content-center">
                                    {{$registros->appends([
                                        'fecha_i' => $fecha_i,
                                        'fecha_f' => $fecha_f
                                        ])->links()}}
                                </div>
                               
                            
                                
                            <div class="modal-footer">
                                <form action="{{route('registro.actividad.descargar')}}">
                                    <input name="fecha_i" type="hidden" value="{{$fecha_i}}">
                                    <input name="fecha_f" type="hidden" value="{{$fecha_f}}">
                                    <button class="btn btn-success" >Descargar registro</button>
                                </form>
                                
                            </div>
                        </div>
                        
                    {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('jsExtra')

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script> --}}

{{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script> --}}

<script type="text/javascript">
$(document).ready(function() {
    $('#archivos').css("display", "none");
    $('#select2tipo').change(function () {
        if ($(this).val() != ''){
            console.log($(this).val());
            if($(this).val() != 1 || $(this).val() != '1'){
                $('#contenido').css("display", "none");
                $('#archivos').css("display", "");
            }else{
                $('#contenido').css("display", "");
                $('#archivos').css("display", "none");
            }
        }
    });
    $('.select2').select2();

    
});
function cambiarContenido(){
    var x = document.getElementById("select2tipo").value;
    console.log(x)
    if(x==1){

    }else if(x==2){
        console.log("video")
        document.getElementById("inputArchivo").accept = "video/*";
    }else if(x==3)
    {
        document.getElementById("inputArchivo").accept= "image/*";   
    } else if(x==4){
        document.getElementById("inputArchivo").accept = "audio/*";
    }
}
$('#inputArchivo').change(function (e) {
    var fileSize = $('#inputArchivo')[0].files[0].size;
    var siezekiloByte = parseInt(fileSize / 1024);
    if (siezekiloByte >  3000) {
        alert("Archivo muy grande");
       this.value='';
    }
    });
</script>



@endsection
