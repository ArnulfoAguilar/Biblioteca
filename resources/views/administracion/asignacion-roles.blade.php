@extends('layouts.adminLTE')
@section('cssextra')
<!--ESTE ES PARA SUMMERNOTE

-->
@endsection
@section('Encabezado')
Asignacion de roles a usuarios
@endsection

@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active">Asignar Roles</li>
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
                <div class="card-header bg-dark">Asignar Rol a Usuario
                </div>
                <div class="card-body">
                    <form action="{{ route('asignar.rol') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-md-6 col-xs-12">
                                <label for="nombre">Usuario</label>
                                <input type="hidden" id="id" name="id" value="{{$user ? $user->id : "" }}">
                                <input type="text" class="form-control" name="nombre" aria-describedby="emailHelp" required
                                    value="{{$user ? $user->name : "" }}" disabled>
                            </div>
                            <div class="form-group col-md-6 col-xs-12">
                                <label for="Rol">
                                    Rol
                                </label>
                                <div>
                                    <select class="form-control select2" id="ID_ROL" name="ID_ROL" 
                                        {{$user ?  : 'disabled' }}>
                                        <option selected value="" disabled>Seleccione el tipo </option>
                                        @foreach($roles as $rol)
                                           <option value="{{ $rol->id }}" {{$user ? ( ($user->ID_ROL == $rol->id) ? 'selected' : "") : ""}}>{{ $rol->ROL }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" {{$user ?  : 'disabled' }}>Guardar</button>
                            <a href="{{ route('asignar.roles') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">Usuarios del sistema
                </div>
                <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <th scope="row">{{$usuario->id}}</th>
                                        <td>{{$usuario->name}}</td>
                                        <td>{{$usuario->email}}</td>
                                        <td>
                                            @foreach ($roles as $rol)
                                                @if ($rol->id == $usuario->ID_ROL)
                                                    {{$rol->ROL}} 
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('asignar.roles',$usuario) }}" class="btn btn-primary btn-sm">Asignar Rol</a>
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
{{-- <asignacion-roles></asignacion-roles> --}}

@endsection