@extends('layouts.adminLTE')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h2 class="text-center">¡ Bienvenid@ a la principal !</h2>

    <br>
    <div class="row">
        @if (Auth::user()->rol->id == 1)
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
    
                        <p>Aportes habilitados</p>
                        <h4>{{$habilitados}}</h4>

                    </div>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        
        @if (Auth::user()->rol->id == 1)
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-info">
                    <div class="inner">
    
                        <p>Aportes Pendientes</p>
                        <h4>{{$pendientes}}</h4>

                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        
        @if (Auth::user()->rol->id == 1)
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-gray">
                    <div class="inner">

                        <p>Ultimas sugerencias de adquisición</p>
                        <h4>{{$sugerencias}}</h4>

                    </div>
                    <div class="icon">
                        <i class="fab fa-wpforms"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
    </div>

    <br>

    <div class="row">
            @if (Auth::user()->rol->id == 1)
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-light">
                        <div class="inner">
        
                            <p>Prestamos realizados</p>
                            <h4>#</h4>

                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endif
            
            @if (Auth::user()->rol->id == 1)
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">

                        <p>Aportes creados en la ultima semana</p>
                        <h4>{{$aportes}}</h4>

                    </div>
                    <div class="icon">
                        <i class="fab fa-wpforms"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
            
            @if (Auth::user()->rol->id == 1)
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
    
                            <p>Ultimas sugerencias</p>
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

