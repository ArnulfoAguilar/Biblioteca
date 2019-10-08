@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection
@section('Encabezado')
Crea tu Aporte
@endsection

@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Aportes</a></li>
    <li class="breadcrumb-item active">Nuevo Aporte</li>
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
                    <div class="card-header" style="background-color:#343A40!important; color:white!important;">Nuevo Aporte</div>
                    
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
                        <form  action="{{ route('aportes.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label for="TIPO_APORTE">
                                           Tipo de Aporte
                                        </label>
                                        <div >
                                            <select class="form-control select2" id="select2tipo" style="width: 100%;" onchange="cambiarContenido()" name="ID_TIPO_APORTE" required>
                                                <option selected value="" disabled>Seleccione el tipo </option>
                                               @foreach($TipoAportes as $TipoAporte)
                                               <option value="{{ $TipoAporte->id }}">{{ $TipoAporte->TIPO_APORTE }}</option>
                                               @endforeach
                                             </select>
                                        </div>
                                    </div>
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="AREA">
                                       Area
                                    </label>
                                    <div >
                                        <select class="form-control select2" id="select2area" style="width: 100%;" name="ID_AREA" required>
                                            <option selected value="" disabled>Seleccione el Area </option>
                                           @foreach($Areas as $Area)
                                           <option value="{{ $Area->id }}">{{ $Area->AREA }}</option>
                                           @endforeach
                                         </select>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="Titulo">Titulo</label>
                                    <input type="text"  class="form-control" name="TITULO"
                                        aria-describedby="Titulo" required>
                                </div>
                                <div class="form-group">
                                    <label for="Descripcion">Descripcion</label>
                                    <input type="text"  class="form-control" name="DESCRIPCION"
                                        aria-describedby="Descripcion" required>
                                </div>
                                <div class="form-group" id="contenido">
                                    <label for="Contenido">Contenido</label>
                                    <textarea type="text" class="form-control" id="Summernote" name ="CONTENIDO" rows="20" >
                                    </textarea> 
                                </div>
                                <div class="form-group" id="archivos">
                                    <input type="file" accept="image/*" name="archivo" id="inputArchivo">
                                </div>
                                <div class="form-group">
                                    <label for="PALABRAS_CLAVE">
                                       Palabras Clave
                                    </label>
                                    <div >
                                        <select class="select2" name="PALABRAS_CLAVE[]" multiple="multiple" required>
                                            @foreach($PalabrasClave as $PalabraClave)
                                           <option value="{{ $PalabraClave->id }}">{{ $PalabraClave->PALABRA }}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                     
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch3" name="customSwitch3" >
                                    <label class="custom-control-label" for="customSwitch3">¿Permitir comentarios?</label>
                                    </div>
                                </div> 
                                
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <button class="btn btn-danger">Cancelar</button>
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

</script>
@endsection
