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

                    <div class="card-body">
                        <form  action="{{ route('aportes.update', $aporte->id) }}" method="post">
                            {{ csrf_field() }}  
                            {{ method_field('PUT') }}                         
                                <div class="row">
                                        <div class="form-group col-md-6 col-xs-12">
                                            <label for="TIPO_APORTE">
                                               Tipo de Aporte
                                            </label>
                                            <div >
                                                <select class="form-control select2" id="select2tipo" style="width: 100%;" name="ID_TIPO_APORTE" required>
                                                    <option selected value="{{ $TipoAporteSelect->id }}" disabled>{{ $TipoAporteSelect->TIPO_APORTE }}</option>
                                                   
                                                 </select>
                                            </div>
                                        </div>

                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="AREA">
                                       Area
                                    </label>
                                    <div >
                                        <select class="form-control select2" id="select2tipo" style="width: 100%;" name="ID_AREA" required>
                                            
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

                            @if ($TipoAporteSelect->id==1)
                            <div class="form-group hidden-print" id="contenido" >
                                <label for="Contenido">Contenido</label>
                                <textarea type="text" class="form-control" id="Summernote" name ="CONTENIDO" rows="20" required>
                                    {!! $aporte->CONTENIDO !!}
                                </textarea>
                            </div>
                            @elseif($TipoAporteSelect->id==2)

                            <div class="form-group" id="archivos">
                                <video src="{{ $aporte->CONTENIDO }}" width="640" height="480" muted controls></video>
                                <input type="file" accept="video/*" name="archivo" id="inputArchivo">
                            </div>
                            
                            @elseif($TipoAporteSelect->id==3)
                            <div class="form-group" id="archivos">
                                <img src="{!! $aporte->CONTENIDO !!}" alt="Logotipo de HTML5" width="400" height="453">
                                <input type="file" accept="video/*" name="archivo" id="inputArchivo">
                            </div>
                            @else
                            <div class="form-group" id="archivos">
                                <audio src="{{ $aporte->CONTENIDO }}" autoplay loop controls></audio>
                                <input type="file" accept="video/*" name="archivo" id="inputArchivo">
                            </div>
                            @endif 
                                <div class="form-group">
                                        <label for="PALABRAS_CLAVE">
                                           Palabras Clave
                                        </label>
                                        <div >
                                            <select class="select2" name="PALABRAS_CLAVE[]" id="selectmult" multiple="multiple" required>
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
});
    </script>
@endsection
