@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Configuracion</a></li>
    <li class="breadcrumb-item active">Variables Globales</li>
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
                    <div class="card-header" style="background-color:#343A40!important; color:white!important;">Variables Globales</div>
                    
@if(!empty($errors->all()))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-ban"></i> Alerta</h5>
    <div class="">
        <h4 class="col-md-4">Por favor, valida los siguientes errores:</h4>
            <ul>
                @foreach ($errors->all() as $mensaje)
                    <li>
                        {{$mensaje}}
                    </li>
                @endforeach
            </ul>
    </div>

</div>
@endif
                    <div class="card-body">
                        <form  action="{{ route('Configuracion.update') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                               
                            <input type="hidden" name="id" value="{{$configuraciones->id}}">
                            <div class="row">
                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="Titulo">Días Habiles de Préstamo</label>
                                    <input type="number"  class="form-control" name="diasHabiles" value="{{$configuraciones ? $configuraciones->DIAS_HABILES_PRORROGA : ''}}" 
                                        placeholder="{{$configuraciones ? $configuraciones->DIAS_HABILES_PRORROGA : ''}}"
                                        aria-describedby="Titulo" required>
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="Titulo">Días para prórroga</label>
                                    <input type="number"  class="form-control" name="diasProrroga" value="{{$configuraciones ? $configuraciones->DIAS_PRORROGABLES : ''}}" 
                                        placeholder="{{$configuraciones ? $configuraciones->DIAS_PRORROGABLES : ''}}"
                                        aria-describedby="Titulo" required>
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="Titulo">Tamaño de Archivo (Kb)</label>
                                    <input type="number"  class="form-control" name="archivoSize" placeholder="{{$configuraciones ? $configuraciones->TAMAÑO_MAXIMO_ARCHIVOS : ''}} Kb"
                                        value="{{$configuraciones ? $configuraciones->TAMAÑO_MAXIMO_ARCHIVOS : ''}}"
                                        aria-describedby="Titulo" required>
                                </div>                            
                            </div><div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    @if($configuraciones)
                                        @if ( $configuraciones->HABILITAR_COMENTARIOS )
                                            <input type="checkbox" class="custom-control-input" checked id="customSwitch3" name="customSwitch3" >
                                        @endif
                                    @endif
                                    <input type="checkbox" class="custom-control-input" id="customSwitch3" name="customSwitch3" >
                                    <label class="custom-control-label" for="customSwitch3">¿Permitir comentarios?</label>
                                    </div>
                                </div> 
                                
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <button class="btn btn-danger">Cancelar</button>
                            </div>
                        </div>
                        
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('jsExtra')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script> --}}

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
