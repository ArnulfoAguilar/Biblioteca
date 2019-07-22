@extends('layouts.app')

@section('content')
<div class="row">
@foreach($tags as $tag)
        <div class="col-lg-3 justify-content-center">
            <div class="card text-center">
                <ul class="list-group">
                    <li class="list-group-item">
                        <p>
                            {{ $tag->EJEMPLAR }}
                        </p>
                        <p> {!! DNS1D::getBarcodeHTML($tag->CODIGO_BARRA, "C128") !!} </p>
                        <p> {{ $tag->CODIGO_BARRA }} </p>
                    </li>
                    
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection