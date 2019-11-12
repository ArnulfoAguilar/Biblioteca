@extends('layouts.adminLTE')

@section('content')
<div class="container" >
    <section class="content">
            <div class="container-fluid">
              <div class="row">
              <biografia-sidebar 
              usuarioid="{{ $usuario->id }}"
              usuarioname="{{ $usuario->name }}"
              rol="{{$usuario->rol->ROL}}"
              biografia="{{$usuario->BIOGRAFIA}}"
              idnivel="{{ $usuario->ID_NIVEL }}"
              >
            </biografia-sidebar>
            <biografia-aportes
                usuarioid="{{ $usuario->id }}"
                >
            </biografia-aportes>
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
</div>
@endsection

