@extends('layouts.adminLTE')
@section('cssextra')
<!--ESTE ES PARA SUMMERNOTE

-->
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
                                    <label for="Titulo">Titulo</label>
                                    <input type="text"  class="form-control" name="TITULO"
                                        aria-describedby="emailHelp" value="{{ $aporte->TITULO}}" required>
                                </div>

                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="AREA">
                                       Area
                                    </label>
                                    <div >
                                        <select class="form-control select2" id="select2tipo" style="width: 100%;" name="ID_AREA">
                                            
                                                <option selected value="{{ $AreaSelec->ID_AREA }}" disabled>{{ $AreaSelec->AREA }}</option>
                                            @foreach($Areas as $Area)
                                                <option value="{{ $Area->id }}">{{ $Area->AREA }}</option>
                                           @endforeach
                                         </select>
                                    </div>
                                </div>
                                </div>
                 

                                <div class="form-group">
                                    <label for="DESCRIPCION">Descripción</label>
                                <textarea type="text" class="form-control" id="Summernote" name ="DESCRIPCION"rows="20" 
                                value="" required>{{ $aporte->DESCRIPCION }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="PALABRAS_CLAVE">Palabras Clave</label>
                                    <input type="text" class="form-control" name="PALABRAS_CLAVE"
                                        aria-describedby="emailHelp" value="{{ $aporte->PALABRAS_CLAVE }}" required>
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
