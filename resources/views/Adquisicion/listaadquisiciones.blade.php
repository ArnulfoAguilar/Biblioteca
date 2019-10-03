@extends('layouts.adminLTE')

@section('content')

    <div class="container">
    <adquisiciones usuario="{{Auth::user()->id}}"></adquisiciones>
    </div>

@endsection
