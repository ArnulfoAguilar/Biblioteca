@extends('layouts.adminLTE')
@section('Encabezado')
   Mis préstamos realizados
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Biblioteca</a></li>
        <li class="breadcrumb-item active">Mis Préstamos</li>
    </ol>
@endsection
@section('content')
<prestamos-mi-lista></prestamos-mi-lista>
@endsection
