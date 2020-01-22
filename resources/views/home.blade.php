@extends('layouts.adminLTE')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h2 class="text-center">¡ Bienvenido a la principal !</h2>

    <br>
    <div class="row">
        @if (Auth::user()->hasPermiso([29]))
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
    
                        <p>Aportes habilitados</p>
                        <h4>{{$habilitados}}</h4>

                    </div>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                    {{-- <a href="{{route('aportes.index',['id'=>1])}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a> --}}
                    <a href="{{route('aportes.index')}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-info">
                    <div class="inner">
    
                        <p>Aportes Pendientes</p>
                        <h4>{{$pendientes}}</h4>

                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <a href="{{route('aportes.index')}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-gray">
                    <div class="inner">

                        <p>Últimas sugerencias de adquisición</p>
                        <h4>{{$sugerencias}}</h4>

                    </div>
                    <div class="icon">
                        <i class="fab fa-wpforms"></i>
                    </div>
                    <a href="{{route('adquisicion.lista')}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
    </div>

    <br>

    <div class="row">
            @if (Auth::user()->hasPermiso([29]) )
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-light">
                        <div class="inner">
        
                            <p>Préstamos realizados</p>
                            <h4>{{$prestamos}}</h4>

                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <a href="{{route('prestamos')}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">

                        <p>Aportes creados en la última semana</p>
                        <h4>{{$aportes}}</h4>

                    </div>
                    <div class="icon">
                        <i class="fab fa-wpforms"></i>
                    </div>
                    <a href="{{route('aportes.index')}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        
            <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
    
                            <p>Alguna otra estadística</p>
                            <h4>#</h4>

                        </div>
                        <div class="icon">
                            <i class="fas fa-ban"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endif
        </div>
    

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

@endsection

