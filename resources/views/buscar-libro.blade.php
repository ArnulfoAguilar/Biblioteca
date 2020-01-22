@extends('layouts.adminLTE')

@section('Encabezado')
Búsqueda de libros
@endsection

@section('breadcrumbs')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Biblioteca</a></li>
    <li class="breadcrumb-item active">Búsqueda de libros</li>
  </ol>
@endsection

@section('content')
    <buscar-material :is-bibliotecario="false"></buscar-material>
@endsection
