@extends('layouts.adminLTE')
@section('cssextra')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
@endsection


@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active">Editar Usuario</li>
  </ol>
@endsection

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close btn btn-sm btn-danger" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <form  id="editarUsuario" action="{{route('administracion.gestion.usuario.edit.post')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-header bg-dark">Editando Usuario</div>
                        
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
                            <div class="row">
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="Titulo">Nombres</label>
                                    <input type="text"  class="form-control" name="nombres" value="{{$user ? $user->name : ''}}" 
                                        required maxlength="255">
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="Titulo">Apellidos</label>
                                    <input type="text"  class="form-control" name="apellidos" value="{{$user ? $user->apellidos : ''}}" 
                                        required maxlength="255">
                                </div>
                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="Titulo">Email</label>
                                    <input type="text"  class="form-control" name="email" value="{{$user ? $user->email : ''}}" 
                                        required maxlength="255">
                                </div>
                                
                                
                            </div>

                            <div class="alert alert-warning alert-block">
                                <strong>Si no desea cambiar la contraseña, favor dejar el campo en blanco. El sistema no modificará la contraseña actual</strong>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4 col-xs-12">
                                    <label for="Titulo">Nueva Contraseña</label>
                                    <input type="text"  class="form-control" name="password" value=""
                                        maxlength="200">
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('jsExtra')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script> --}}

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
@endsection
