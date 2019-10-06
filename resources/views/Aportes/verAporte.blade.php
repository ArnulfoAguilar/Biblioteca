@extends('layouts.adminLTE')
@section('title')
    Mi Aporte
@endsection

@section('cssextra')
<style type="text/css">
    img {
      max-width: 100%; 
      }
      video{
      max-width: 100%; 
      }
      audio{
        max-width: 100%; 
        min-width: 100%; 
      }
</style>

{{-- <link href="toastr.css" rel="stylesheet"/> --}}

   
@endsection 

@section('content')
{{-- {!! Toastr::render() !!} --}}
{!! toastr()->render() !!}

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="container">
            <div class="col-md-12">
                    <div class="card">
                      <div class="card-header p-2">
                        <ul class="nav nav-pills">
                          <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Aporte</a></li>
                          <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Revisiones</a></li>
                          <li class="nav-item"><a class="nav-link" href="#comentarios" data-toggle="tab">Comentarios</a></li>
                        </ul>
                      </div><!-- /.card-header -->
                      <div class="card-body">
                        <div class="tab-content">
                          <div class="tab-pane active" id="activity">
                     
                                @foreach ($PalabrasClave as $palabraClave)
                                    <p href="#" class="btn btn-sm btn-primary col-xs-1">
                                        {{ $palabraClave->PALABRA}}
                                    </p>    
                                @endforeach 
                                @if ($aporte->HABILITADO == false)
                                            <habilitar-aporte aporte="{{$aporte->id}}"></habilitar-aporte>  
                                @endif 
                                <div class="container">    
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header bg-dark" >
                                                    <div class="row">
                                                    <h4 class="col-md-10">{{ $aporte->TITULO }}</h4>
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
                                                                                                
                                                        @if ($aporte->ID_TIPO_APORTE==1)
                                                            {!! $aporte->CONTENIDO !!}
                                                            
                                                        @elseif($aporte->ID_TIPO_APORTE==2)
                                                            <p>{{$aporte->DESCRIPCION}}</p><br>
                                                            <video src="{{ $aporte->CONTENIDO }}" width="640" height="480" muted controls></video>
                                                        
                                                        @elseif($aporte->ID_TIPO_APORTE==3)
                                                            <p>{{$aporte->DESCRIPCION}}</p><br>
                                                            <img src="{!! $aporte->CONTENIDO !!}" alt="Logotipo de HTML5" width="400" height="453">
                                                        
                                                        @else
                                                            <p>{{$aporte->DESCRIPCION}}</p><br>
                                                            <audio src="{{ $aporte->CONTENIDO }}" autoplay loop controls></audio>

                                                        @endif 
                                                </div>
                                                @if ($aporte->COMENTARIOS==1 )
                                                <comentarios aporte="{{ $aporte->id }}" usuario=" {{ Auth::user()->id }}"></comentarios>
                                                @endif  
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                          </div>
                          <div class="tab-pane" id="timeline">
                                <revisiones aporte="{{$aporte->id}}" area="{{$aporte->ID_AREA}}" rol="{{Auth::user()->ID_ROL}}" usuario="{{Auth::user()->id}}"></revisiones>
                          </div>

                            <div class="tab-pane" id="comentarios">
                                <habilitar-comentarios aporte="{{$aporte->id}}"></habilitar-comentarios>
                            </div>

                        </div>
                        <!-- /.tab-content -->
                      </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                  </div>
            </div>
        </div>
    </div>
    
    

@endsection

@section('jsExtra')

{{-- <script src="jquery.min.js"></script>
<script src="toastr.js"></script> --}}
   
@endsection 