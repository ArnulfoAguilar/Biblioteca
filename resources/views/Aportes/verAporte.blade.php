@extends('layouts.adminLTE')
@section('title')
    Mi Aporte
@endsection
@section('cssextra')
<!--ESTE ES PARA SUMMERNOTE

-->
@endsection
@section('Encabezado')
    <a class="btn btn-app" href="{{ route('aportes.edit', $aporte->id)}}">
        <i class="fas fa-edit"></i> Edit
    </a>
@endsection
@section('breadcrumbs')
<div class="float-right">
        Creado el: {{ $aporte->created_at }}
</div>
@endsection    

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
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
                    <div class="card-header" style="background-color:#343A40!important; color:white!important;"><h1>{{ $aporte->TITULO }}</h1></div>
                    <div class="card-body">
                        {!! $aporte->DESCRIPCION !!}
                    </div>
                    
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Revisiones</h3>
                    </div>
                    <div class="card-body">
                            {{-- <div class="tab-pane active" id="timeline">
                                <!-- The timeline -->
                                <ul class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <li class="time-label">
                                    <span class="bg-danger">
                                        11 Feb. 2014
                                    </span>
                                    </li>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <li>
                                    <i class="fas fa-eye bg-primary"></i>
            
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 12:05</span>
            
                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
            
                                        <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                        </div>
                                        <div class="timeline-footer">
                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    </div>
                                    </li>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <li>
                                    <i class="fas fa-check-circle bg-info"></i>
            
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
            
                                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                        </h3>
                                    </div>
                                    </li>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <li>
                                    <i class="fas fa-comments bg-warning"></i>
            
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>
            
                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
            
                                        <div class="timeline-body">
                                        Take me to your leader!
                                        Switzerland is small and neutral!
                                        We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class="timeline-footer">
                                        <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                        </div>
                                    </div>
                                    </li>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <li class="time-label">
                                    <span class="bg-success">
                                        3 Jan. 2014
                                    </span>
                                    </li>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <li>
                                    <i class="fas fa-camera bg-purple"></i>
            
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 2 days ago</span>
            
                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
            
                                        <div class="timeline-body">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        </div>
                                    </div>
                                    </li>
                                    <!-- END timeline item -->
                                    <li>
                                    <i class="far fa-clock bg-gray"></i>
                                    </li>
                                </ul>
                            </div> --}}

                            {{-- <div class="tab-pane active" id="timeline">
                                <!-- The timeline -->
                                <ul class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <li class="time-label">
                                    <span class="bg-danger">
                                        11 Feb. 2014
                                    </span>
                                    </li>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <li>
                                        <i class="fas fa-eye bg-warning"></i>
                
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>
                
                                            <h3 class="timeline-header"><a href="#">{{Auth::user()->name}}</a> Te hizo una corrección</h3>
                
                                            <div class="timeline-body">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                            quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <li>
                                        <i class="fas fa-check-circle bg-success"></i>
                
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
                
                                            <h3 class="timeline-header border-0"><a href="#">{{Auth::user()->name}}</a> Te hizo una corrección</h3>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->
                                    
                                    <li>
                                    <i class="far fa-clock bg-gray"></i>
                                    </li>
                                </ul>
                            </div> --}}

                    <revisiones aporte="{{$aporte->id}}" area="{{$aporte->ID_AREA}}"></revisiones>

                    </div>
                </div>
            </div>
        </div>
    </div>    
    
    

@endsection
