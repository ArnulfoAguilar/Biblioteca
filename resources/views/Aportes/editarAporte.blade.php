@extends('layouts.adminLTE')
@section('cssextra')

@endsection
@section('Encabezado')
Editar 
@endsection

@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Aportes</a></li>
    <li class="breadcrumb-item active">Editar Aporte </li>
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
                    <div class="card-header" style="background-color:#343A40!important; color:white!important;">Editar Aporte</div>
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
                        <form  action="{{ route('aportes.update', $aporte->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}  
                            {{ method_field('PUT') }}                         
                                <div class="row">
                                        <div class="form-group col-md-6 col-xs-12">
                                            <label for="TIPO_APORTE">
                                               Tipo de Aporte
                                            </label>
                                            <div >
                                                <select class="form-control select2" id="select2tipo" style="width: 100%;" name="ID_TIPO_APORTE" >
                                                    <option selected value="{{ $TipoAporteSelect->id }}" >{{ $TipoAporteSelect->TIPO_APORTE }}</option>                          
                                                 </select>
                                            </div>
                                        </div>

                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="AREA">
                                       Area
                                    </label>
                                    <div>
                                        <select class="form-control select2" id="select2tipo" style="width: 100%;" name="ID_AREA" >
                                                <option selected value="{{ $AreaSelec->ID_AREA }}" disabled>{{ $AreaSelec->AREA }}</option>
                                            @foreach($Areas as $Area)
                                                <option value="{{ $Area->id }}">{{ $Area->AREA }}</option>
                                           @endforeach
                                         </select>
                                    </div>
                                </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="Titulo">Titulo</label>
                                <input type="text"  class="form-control"  value="{{$aporte->TITULO}}" name="TITULO"
                                        aria-describedby="Titulo" required>
                                </div>

                                <div class="form-group">
                                    <label for="Descripcion">Descripcion</label>
                                    <input type="text"  class="form-control" value="{{$aporte->DESCRIPCION}}" name="DESCRIPCION"
                                        aria-describedby="Descripcion" required>
                                </div>

                                <div class="form-group" id="contenido">
                                        <label for="Contenido">Contenido</label>
                                        @if($TipoAporteSelect->id==1)
                                        <textarea type="text" class="form-control" id="Summernote" name ="CONTENIDO" rows="20" >
                                        {!! $aporte->CONTENIDO !!}
                                        </textarea> 
                                        @endif
                                    </div>
                                
                                <div class="form-group" id="archivos">
                                    @if($TipoAporteSelect->id==2)
                                    <video src="{{ $aporte->CONTENIDO }}" width="640" height="480" muted controls></video>
                                    @elseif($TipoAporteSelect->id==3)
                                    <img src="{!! $aporte->CONTENIDO !!}" alt="Logotipo de HTML5" width="400" height="453">
                                    @else
                                    <audio src="{{ $aporte->CONTENIDO }}" loop controls></audio>
                                    @endif
                                    <br>
                                        <input type="file" accept="image/*" name="archivo" id="inputArchivo">
                                </div>
                                <div class="form-group">
                                        <label for="PALABRAS_CLAVE">
                                           Palabras Clave
                                        </label>
                                        <div >
                                            <select class="select2 form-control" name="PALABRAS_CLAVE[]" id="selectmult" multiple="multiple" required>
                                                @foreach($PalabrasClave as $PalabraClave)
                                               <option value="{{ $PalabraClave->id }}">{{ $PalabraClave->PALABRA }}</option>
                                               @endforeach
                                            </select>
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    @if ( $aporte->COMENTARIOS )
                                    <input type="checkbox" class="custom-control-input" checked id="customSwitch3" name="customSwitch3" >
                                    @endif
                                    
                                    <input type="checkbox" class="custom-control-input"  id="customSwitch3" name="customSwitch3" >
                                    <label class="custom-control-label" for="customSwitch3">¿Permitir comentarios?</label>
                                    </div>
                                </div>     
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <a class="btn btn-danger" href="/aportes/create" role="button">Cancelar</a>
                            </div>
                        
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('jsExtra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {

    $('.select2').select2(); 
    var obj =@json($PalabrasClaveselect);
    myArray = [];
    $.each(obj, 
        function(i, item) {
            myArray.push(item.id);
        });
        $('#selectmult').val(myArray ).trigger('change');
        cambiarContenido();
});
function cambiarContenido(){
    var x = document.getElementById("select2tipo").value;
    if(x==1){
        $('#contenido').css("display", "");
        $('#archivos').css("display", "none");
    }else if(x==2){
        //Video
        $('#contenido').css("display", "none");
        $('#archivos').css("display", "");
        console.log("video")
        document.getElementById("inputArchivo").accept = "video/*";
    }else if(x==3)
    {
        //Pintura
        $('#contenido').css("display", "none");
        $('#archivos').css("display", "");
        document.getElementById("inputArchivo").accept= "image/*";   
    } else if(x==4){
        //Musica
        $('#contenido').css("display", "none");
        $('#archivos').css("display", "");
        document.getElementById("inputArchivo").accept = "audio/*";
    }
}
$('#inputArchivo').change(function (e) {

    var fileSize = $('#inputArchivo')[0].files[0].size;

    var siezekiloByte = parseInt(fileSize / 1024);
    const TamañoMax = @json($TamañoMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS);
    if (siezekiloByte >  TamañoMax) {
        swal({ text: 'El archivo debe ser menor a '+ TamañoMax +' Kb', title: 'Upss', icon: 'warning',})
                        
       this.value='';
    }
    });
</script>
@endsection
