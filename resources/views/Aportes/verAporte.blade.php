@extends('layouts.adminLTE')
@section('title')
    Mi Aporte
@endsection

@section('Encabezado')

   
@endsection
@section('breadcrumbs')
<div class="float-right">
    @if ($aporte->ID_USUARIO == Auth::user()->id)
    <a class="btn btn-app" href="{{ route('aportes.edit', $aporte->id)}}">
        <i class="fas fa-edit"></i> Edit
    </a>
    @endif
</div>
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
                    <!-- <div class="card-header d-flex justify-content-between">
                        <div>
                            <h3>Aporte realizado por: {{Auth::user()->name}}</h3>
                        </div>
                        <div>
                            <h3><span class="tag tag-green">Titulo del aporte: {{ $aporte->TITULO }}</span></h3>
                        </div>
                    </div> -->
                    <div class="card-header" style="background-color:#343A40!important; color:white!important;">
                        <div class="row">
                        <h1 class="col-md-10">{{ $aporte->TITULO }}</h1>
                        <span class="col-md-2">{{ $aporte->created_at }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $aporte->CONTENIDO !!}
                        
                    </div>
                    @if ($aporte->COMENTARIOS==1)
                    <comentarios aporte="{{ $aporte->id }}" usuario=" {{ Auth::user()->id }}"></comentarios>
                    @endif  
                </div>
                
                
                <!--div class="card">
                    <div class="card-header">
                        <h3>Revisiones</h3>
                    </div>
                    <div class="card-body">
                        
                        {{-- Si esto en algun momento da problemas, yo lo solvente asi:  --}}
                        {{-- copien la linea de revisiones con los parametros, se los quitan, y luego guardan --}}
                        {{-- luego se los vuelven a poner tal y como estaba  --}}

                    {{-- <revisiones aporte="{{$aporte->id}}" area="{{$aporte->ID_AREA}}"></revisiones> --}}
                    {{-- <revisiones></revisiones> --}}
                    <revisiones aporte="{{$aporte->id}}" area="{{$aporte->ID_AREA}}"></revisiones>
                    </div>
                    <comentarios aporte="{{ $aporte->id }}" usuario=" {{ Auth::user()->id }}"></comentarios>
                </div-->  
                  
            </div>
        </div>
    </div>
    
    

@endsection
