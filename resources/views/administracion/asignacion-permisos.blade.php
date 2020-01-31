@extends('layouts.adminLTE')
@section('cssextra')
<!--ESTE ES PARA SUMMERNOTE

-->
@endsection
@section('Encabezado')
Asignación de Permisos a Roles
@endsection

@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active">Asignar Permisos</li>
</ol>
@endsection

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="container-fluid">
    <div class="row ">
        <form class="col-12" action="{{ route('administracion.asignar.permiso.post') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    {{-- <button type="button" class="close" data-dismiss="alert">×</button>	 --}}
    <a class="close" href="{{route('administracion.asignar.permiso')}}" role="button">x</a>
        <strong>{{ $message }}</strong>
</div>
@endif

            <label>Editar Asignación de Rol:</label>
            <input name="id_rol" type="hidden" class="form-control" value="{{$rol? $rol->id : '' }}">
            <input name="nombre_rol" type="text" class="form-control" 
                placeholder="Seleccione un rol..." required 
                {{ $rol ? 'disabled' : 'disabled' }} value="{{ $rol ? $rol->ROL:'' }}"
            >
            <label>Permisos asignados al rol:</label>
            <select multiple name="permisos[]" class="form-control multiple" {{ $rol ? '' : 'disabled' }}>
                <option disabled value="">Por favor seleccione una</option>
                    @foreach ($permisos as $permiso)
                        <option value="{{$permiso->id}}"
                            @if ($rol)
                                @if ($rol->permisos->count() > 0)
                                    @foreach ($rol->permisos as $permisodelrol)
                                        @if ($permisodelrol->id == $permiso->id)
                                            selected
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                            >
                            {{$permiso->nombre}}</option>
                    @endforeach
            </select>
            <div class="d-flex justify-content-end">
                <button class="btn btn-success col-md-2" type="submit" {{ $rol ? '' : 'disabled' }}>Guardar</button>
                <a class="btn btn-danger col-md-2" href="{{route('administracion.asignar.permiso')}}" role="button">Cancelar</a>
            </div>
            

            {{-- <div class="col-sm-12 mb-3">
                <label for="NOMBRE">Editar Asignación de Rol:</label>
                <div class="input-group">
                    <input name="id_rol" class="form-control" value="{{$rol? $rol->id : '' }}" disabled>
                    <input type="text" class="form-control col-md-9" placeholder="Seleccione un rol..." required
                    {{ $rol ? 'disabled' : 'disabled' }} value="{{ $rol ? $rol->ROL:'' }}" 
                    > 
                        
                    <div class="row col-md-3">
                        <button class="btn btn-success col-md-6" type="submit" {{ $rol ? '' : 'disabled' }}>Guardar</button>
                        <button class="btn btn-danger col-md-6 cancelar" {{ $rol ? '' : 'disabled' }}>Cancelar</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 mb-3">
                <select multiple class="form-control multiple" {{ $rol ? '' : 'disabled' }}>
                    <option disabled value="">Por favor seleccione una</option>
                        @foreach ($permisos as $permiso)
                            <option value="{{$permiso->id}}"
                                @if ($rol)
                                    @if ($rol->permisos->count() > 0)
                                        @foreach ($rol->permisos as $permisodelrol)
                                            @if ($permisodelrol->id == $permiso->id)
                                                selected
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                                >
                                {{$permiso->nombre}}</option>
                        @endforeach
                </select>
            </div> --}}
        </form>

        <div class="col col-12 mt-3">
            <div class="card">
                <div class="card-header bg-dark">
                    Roles
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="roles">
                        <thead>
                            <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Permisos</th>
                            <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $rol)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$rol->ROL}}</td>
                                    <td>
                                        @if ($rol->permisos->count() > 0)
                                            @foreach ($rol->permisos as $permiso)
                                                <div>{{$permiso->nombre}}</div>
                                            @endforeach
                                        @else
                                        --Sin asignar--
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <a href="{{route('administracion.asignar.permiso', $rol)}}" class="btn btn-primary btn-sm" >Asignar Permiso</a>
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
@endsection

@section('jsExtra')

<link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

    <script type="text/javascript">

        $('#roles').DataTable({
            "order": [[ 0, "asc" ]]
        });

        $(document).ready(function() {
            $('.multiple').select2();
            $('.cancelar').click( function() {
                console.log('Entro')
                window.location.replace("http://127.0.0.1:8000/administracion/asignar/permisos");
            })
        });
    </script>
@endsection


<script type="text/javascript">
    
    $(document).ready( function () {
        

        $(".cancelar").click(function(){
            var id = $(this).data('pres');
            var _token = $('input[name="_token"]').val();

            swal({
                title: "¿Está seguro de cancelar este préstamo?",
                text: "El libro estará disponible para otros préstamos",
                icon: "warning",
                buttons: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('cancelar.prestamo')}}",
                        method: "POST",
                        data: {
                            id: id,
                            _token: _token,
                        },
                        success: function (result) {
                            swal({ icon: 'success', title: 'Éxito', text: 'Préstamo cancelado exitosamente',})
                            .then((value) => {
                                location.reload();
                            });
                        },
                        error: function (result) {
                            swal({ icon: 'error', title: 'Error', text: 'Intente de nuevo. Si eso no funciona contacte al administrador',})
                            .then((value) => {
                                location.reload();
                            });
                        },
                    })
                } else {
                    location.reload();
                }
            });

        });

    } );

</script>