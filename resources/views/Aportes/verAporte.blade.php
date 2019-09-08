@extends('layouts.adminLTE')
@section('title')
    Mi Aporte
@endsection

@section('cssextra')
<style type="text/css">
    img {
      max-width: 100%; 
      }
</style>
   
@endsection 

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
        @foreach ($PalabrasClave as $palabraClave)
                <p href="#" class="btn btn-sm btn-primary col-xs-1">
                    {{ $palabraClave->PALABRA}}
                </p>    
        @endforeach
    </div>
    <div class="container">    
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color:#343A40!important; color:white!important;">

                        <!-- <h1>{{ $aporte->TITULO }}</h1> -->

                        <div class="row">
                        <h1 class="col-md-10">{{ $aporte->TITULO }}</h1>
                        <span class="col-md-2">{{ $aporte->created_at }}</span>
                        </div>

                    </div>
                    <div class="card-body">
                            <div class="float-right">
                                    @if ($aporte->ID_USUARIO == Auth::user()->id)
                                    <a class="btn btn-app" href="{{ route('aportes.edit', $aporte->id)}}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @endif
                            </div>
                        {!! $aporte->CONTENIDO !!}
                        
                    </div>
                    @if ($aporte->COMENTARIOS==1)
                    <comentarios aporte="{{ $aporte->id }}" usuario=" {{ Auth::user()->id }}"></comentarios>
                    @endif  
                </div>


                <revisiones aporte="{{$aporte->id}}" area="{{$aporte->ID_AREA}}" rol="{{Auth::user()->ID_ROL}}" usuario="{{Auth::user()->id}}"></revisiones>


            </div>
        </div>
    </div>
    
    

@endsection
