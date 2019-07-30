<div class="accordion" id="accordionExample">

    <div class="card" >
        <div class="card-header" id="headingCero">
            <a class="dropdown-item {{ ( request()->is('home') ) ?'active':''}}" href="{{route('home')}}" role="button" data-toggle="" data-target=""
                    aria-expanded="false" aria-controls="collapseCero">
                Home
            </a>
        </div>
    </div>

@if(Auth::user())
    <div class="card">
        <div class="card-header" id="headingOne">
            <a class="dropdown-item {{ ( request()->is('busqueda') ) ?'active':''}}" href="" role="button" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="false" aria-controls="collapseOne">
                Biblioteca
            </a>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('busqueda') }}">Ingreso de libros</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 2</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 3</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 4</a>
            <div class="dropdown-divider"></div>
        </div>
    </div>
@endif

@if(Auth::user())
    <div class="card">
        <div class="card-header" id="headingTwo">
            <a class="dropdown-item {{ ( request()->is('inventario*') ) ?'active':''}}" href="" role="button" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="false" aria-controls="collapseTwo">
                Inventario
            </a>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="dropdown-divider"></div>
            <!-- <a class="dropdown-item" href="#">Action</a> -->
            <a class="dropdown-item {{ ( request()->is('inventario/ejemplares') ) ?'active':''}}" href="{{ route('lista.ejemplares') }}">Lista de ejemplares</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 2</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 3</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 4</a>
            <div class="dropdown-divider"></div>
        </div>
    </div>
@endif

@if(Auth::user())
    <div class="card">
        <div class="card-header" id="headingThree">
            <a class="dropdown-item" href="" role="button" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="false" aria-controls="collapseThree">
                Aportes
            </a>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 1</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 2</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 3</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 4</a>
            <div class="dropdown-divider"></div>
        </div>
    </div>
@endif

@if(Auth::user())
    <div class="card">
        <div class="card-header" id="headingFour">
            <a class="dropdown-item" href="" role="button" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="false" aria-controls="collapseThree">
                    Adquisiciones
            </a>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 1</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 2</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 3</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Item 4</a>
            <div class="dropdown-divider"></div>
        </div>
    </div>
@endif    
</div>

