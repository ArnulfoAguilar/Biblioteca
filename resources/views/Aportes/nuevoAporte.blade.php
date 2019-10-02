@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection
@section('Encabezado')
Nuevo Aporte Escrito   
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

                    <div class="card-body">
                        <form  action="{{ route('aportes.store') }}" method="post">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group col-md-6 col-xs-12">
                                        <label for="TIPO_APORTE">
                                           Tipo de Aporte
                                        </label>
                                        <div >
                                            <select class="form-control select2" id="select2tipo" style="width: 100%;" name="ID_TIPO_APORTE" required>
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
                 

                                <div class="form-group">
                                    <label for="Contenido">Contenido</label>
                                   
                                    <textarea type="text" class="form-control" id="Summernote" name ="CONTENIDO" rows="20" required>
                                    </textarea>
                                    
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
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection
