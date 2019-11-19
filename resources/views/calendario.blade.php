@extends('layouts.adminLTE')

@section('content')
    {{-- <h1>aquí iría el calendario</h1> --}}
    <div class="card">
        <div class="card-header">
            En este espacio se asignan en el calendario los dias de asueto o dias no hábiles; 
            Con esto el sistema estimará una fecha adecuada para la devolución de un préstamo
        </div>
    </div>
    <calendario></calendario>
@endsection
