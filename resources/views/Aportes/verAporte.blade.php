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
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Aporte </a></li>
                          
                        @if ( Auth::user()->hasPermiso([31]) || Auth::user()->id == $aporte->ID_USUARIO  )
                        {{-- @if ( Auth::user()->hasPermiso([31]) ) --}}
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Observaciones</a></li>
                        @endif
                        
                        @if ( Auth::user()->hasPermiso([32]) )
                        <li class="nav-item"><a class="nav-link" href="#comentarios" data-toggle="tab">Comentarios</a></li>
                        @endif

                          
                        </ul>
                      </div><!-- /.card-header -->
                      <div class="card-body">
                        <div class="tab-content">
                          <div class="tab-pane active" id="activity">

                                <h5 >Autor: {{$aporte->usuario->name}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    Estado: {{$aporte->HABILITADO == true ? 'Habilitado' : 'Pendiente de aprobación' }}
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    Área: {{$aporte->area->AREA}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    Visto {{$aporte->VISTAS }} veces
                                </h5>
                               <br>

                                Palabras Clave:
                                @foreach ($PalabrasClave as $palabraClave)
                                    <div class="badge bg-info">{{$palabraClave->PALABRA }}</div>
                                      
                                @endforeach 

                                <br><br>
                                

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
                                                                    <i class="fas fa-edit"></i> Editar
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
                                                            <img src="{!! $aporte->CONTENIDO !!}" alt="Logotipo de HTML5" width="auto" height="auto">
                                                        
                                                        @else
                                                            <p>{{$aporte->DESCRIPCION}}</p><br>
                                                            <audio src="{{ $aporte->CONTENIDO }}" loop controls></audio>

                                                        @endif 
                                                </div>
                                                @if ($aporte->COMENTARIOS==1 && $PermiteComentarios->HABILITAR_COMENTARIOS == 1 )
                                                {{-- <comentarios aporte="{{ $aporte->id }}" usuario=" {{ Auth::user()->id }}"></comentarios> --}}

                                                @foreach ($comentarios as $comentario)
                                                    <div class="card-footer card-comments">
                                                        
                                                        <div class="card-comment" >
                                                        <!-- User image -->
                                                            <img class="img-circle img-sm" src="" alt="">
                                                        
                                                            <div class="comment-text">
                                                            <span class="username">
                                                                {{$comentario->name}}
                                                            <span class="text-muted float-right">{{ $comentario->created_at}}</span>
                                                            </span><!-- /.username -->
                                                            {{ $comentario->COMENTARIO}}
                                                            </div>
                                                                        <!-- /.comment-text -->
                                                            <div class="row float-right">
                                                                {{-- <button type="button"  class="btn btn-default btn-sm " @click="like(datos.id)"><i class="far fa-thumbs-up">{{ datos.total_likes }}</i> Like</button> --}}
                                                                <?php $dioLike = false;?>
                                                                @foreach ($interacciones as $interaccion)
                                                                    @if ($interaccion->id_comentario == $comentario->id)
                                                                        <?php $dioLike = true;?>
                                                                        {{ $comentario->total_likes }} Likes &nbsp;
                                                                        {{-- <button class="dislike" data-i="{{$interaccion->id_interaccion}}" type="button" class="btn btn-default btn-sm " ><i class="fas fa-thumbs-down"></i> Dislike</button> --}}
                                                                        <a href="#"class="link-black text-sm dislike" data-i="{{$interaccion->id_interaccion}}"><i class="far fa-thumbs-down mr-1"></i>Ya no me gusta</a>
                                                                    @endif
                                                                @endforeach
                                                                @if ($dioLike)
                                                                    <?php $dioLike = false;?>
                                                                @else
                                                                    {{ $comentario->total_likes }} Likes &nbsp;
                                                                    {{-- {{ $comentario->total_likes }} Likes <button class="like" data-c="{{$comentario->id}}" type="button"  class="btn btn-default btn-sm " ><i class="far fa-thumbs-up"></i> Like</button> --}}
                                                                    <a href="#"class="link-black text-sm like" data-c="{{$comentario->id}}"><i class="far fa-thumbs-up mr-1"></i>Me gusta</a>
                                                                    @endif
                                                                &nbsp;&nbsp;<a href="#"class="link-black text-sm"><i class="fas fa-ban mr-1"></i>Reportar</a>
                                                                {{-- <button type="button" class="btn btn-default btn-sm "><i class="fas fa-ban"></i> Report</button> --}}
                                                            </div>
                                                        </div>
                                                                        <!-- /.card-comment -->
                                                    </div>
                                                @endforeach
                                                    
                                                    <div class="card-footer">
                                                        <img class="img-fluid img-circle img-sm" src="" alt="">
                                                        <!-- .img-push is used to add margin to elements next to floating images -->
                                                        <div class="img-push">
                                                            {{-- <form @submit.prevent="comprobar_comentario"> --}}
                                                            {{-- <form action="{{route('guardar.comentario')}}" class="create_comentario"> --}}
                                                            <form action="{{route('guardar.comentario')}}" class="create_comentario" method="POST">
                                                            {{ csrf_field() }}
                                                            {{-- <input class="form-control form-control-lg" placeholder="Escribe un comentario..." v-model="Comentario.COMENTARIO"> --}}
                                                            <input name="aporte" type="hidden" value="{{$aporte->id}}">
                                                            <div class="input-group input-group-lg">
                                                                    <input type="text" name="comentario" required class="form-control" placeholder="Escribe un comentario...">
                                                                    <span class="input-group-append">
                                                                      <button type="submit" class="btn btn-success btn-flat">Publicar</button>
                                                                    </span>
                                                                  </div>
                                                            </form>  
                                                        </div>
                                                    </div>



                                                @endif  
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                          </div>
                          <div class="tab-pane" id="timeline">
                                <revisiones aporte="{{$aporte->id}}" area="{{$aporte->ID_AREA}}" rol="{{Auth::user()->ID_ROL}}" usuario="{{Auth::user()->id}}"></revisiones>
                          </div>

                        @if (Auth::user()->rol->id == 1  )
                            <div class="tab-pane" id="comentarios">
                                <habilitar-comentarios aporte="{{$aporte->id}}"></habilitar-comentarios>
                            </div>
                        @endif

                        </div>
                        <!-- /.tab-content -->
                      </div><!-- /.card-body -->

                      <div class="card-footer">
                        @if ( Auth::user()->hasPermiso([33]) )
                            @if ($aporte->HABILITADO == false)
                                        <habilitar-aporte aporte="{{$aporte->id}}"></habilitar-aporte>  
                            @endif
                        @endif
                      </div><!-- /.card-footer -->

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    
    });

    $('.like').click(function (e) {
        var c = $(this).data('c');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('dar.like') }}",
            method: "POST",
            data: {
                comentario:c,
                _token: _token,
            } ,
            success: function(result) {
                swal({ text: 'Te gusta el comentario', title: 'Like', icon: 'success',})
                        .then( (value) => {
                            location.reload();
                        });
                
            }
        });
    });

    $('.dislike').click(function (e) {
        var i = $(this).data('i');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('dar.dislike') }}",
            method: "POST",
            data: {
                interaccion:i,
                _token: _token,
            } ,
            success: function(result) {
                swal({ text: 'Te ha dejado de gustar el comentario', title: 'Dislike', icon: 'success',})
                        .then( (value) => {
                            location.reload();
                        });
            }
        });
    });

    $('.create_comentario').submit(function (e) {
        e.preventDefault();
        var form = this;
        var texto_ingresado = form.comentario.value;
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('lista.malas.palabras') }}",
            method: "POST",
            data: {
                _token: _token,
            } ,
            success: function(result) {                
                if(texto_ingresado !=''){
                    var regex = new RegExp("("+result+")",'igm')
                    //console.log(regex)
                    const str = texto_ingresado;
                    let palabra_en_comentario;
                    if ((palabra_en_comentario = regex.exec(str)) !== null){
                        if (palabra_en_comentario.index === regex.lastIndex){
                            regex.lastIndex++;
                        }
                        swal({ text: 'Su comentario contiene palabras inadecuadas', title: 'Alto', icon: 'error',})
                    }else{
                        swal({ text: 'Espere la aprobación del administrador', title: 'Exito', icon: 'success',})
                        .then( (value) => {
                            
                            form.submit();
                            return true;
                        });
                    }
                }else{
                    swal({ text: 'Debe escribir un comentario', title: 'Alto', icon: 'warning',})
                }

            },
            error: function(result) {
                swal({ text: 'Su comentario no pudo ser validado', title: 'Error', icon: 'error',})
            }
        });

        if(texto_ingresado == null || texto_ingresado == ''){
            return false;
        }
        
    });
</script>

   
@endsection 