@extends('layouts.adminLTE')
@section('cssextra')
<!--ESTE ES PARA SUMMERNOTE

-->
@endsection
@section('Encabezado')
Gestión de usuarios
@endsection

@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active">Gestión de usuarios</li>
</ol>
@endsection

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif

<div class="container-fluid">
    <div class="row ">
        
        <div class="col col-12 mt-3">

            <div class="alert alert-warning alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>Orden de columnas para importar desde excel: NOMBRES, APELLIDOS, CARNET, EMAIL</strong>
            </div>

            <div class="card">
                <div class="card-header bg-dark">
                    Usuarios
                    <div class=" float-right">
                        <button type="button" class="btn btn-sm btn-success" title="Importar" data-toggle="modal" data-target="#import">
                                <i class="fas fa-users"></i> Importar usuarios Excel
                        </button>
                        {{-- <button type="button" class="btn btn-sm btn-success" title="Importar" >
                                <i class="fas fa-user"></i> Agregar un usuario
                        </button> --}}
                        <a href="{{route('administracion.gestion.usuario.edit')}}" class="btn btn-success btn-sm" > <i class="fas fa-user"></i>Agregar un usuario</a>
                     </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="usuarios">
                        <thead>
                            <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Carnet</th>
                            <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->apellidos}}</td>
                                    <td>{{ $user->carnet ? $user->carnet : 'Sin Carnet' }}</td>
                                    <td>
                                        {{-- <a href="" class="btn btn-primary btn-sm" >Editar</a> --}}
                                        <a href="{{route('administracion.gestion.usuario.edit', $user)}}" class="btn btn-primary btn-sm" >Ver/Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>  

    </div>
</div>

<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        
    <form method="post" action="{{route('administracion.import.usuarios')}}" enctype="multipart/form-data">
    {{csrf_field()}}

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Importar usuarios desde un archivo excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="file" id="file" name="file" accept=".xlsx, .xls">
                    {{-- <div class="input-group m-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01" accept=".xlsx, .xls">
                            <label class="custom-file-label" for="inputGroupFile01">Seleccione un archivo</label>
                        </div>
                    </div>                     --}}
                </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary aprobar">Importar</button>
            </div>        
        </div>

    </form>

    </div>
</div>

@endsection

@section('jsExtra')
<link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    
<script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#usuarios').DataTable();
        document.getElementById("inputArchivo").accept = "xlsx";
    });
</script>
@endsection