<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingCero">
            <a class="dropdown-item" href="{{route('home')}}" role="button" data-toggle="" data-target=""
                    aria-expanded="false" aria-controls="collapseCero">
                Home
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingOne">
            <a class="dropdown-item" href="" role="button" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="false" aria-controls="collapseOne">
                Biblioteca
            </a>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
            <div class="dropdown-divider"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <a class="dropdown-item" href="" role="button" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="false" aria-controls="collapseTwo">
                Inventario
            </a>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="dropdown-divider"></div>
            <!-- <a class="dropdown-item" href="#">Action</a> -->
            <a class="dropdown-item" href="{{ route('lista.ejemplares') }}">Lista de libros</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
            <div class="dropdown-divider"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingThree">
            <a class="dropdown-item" href="" role="button" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="false" aria-controls="collapseThree">
                Aportes
            </a>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
            <div class="dropdown-divider"></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingFour">
            <a class="dropdown-item" href="" role="button" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="false" aria-controls="collapseThree">
                    Adquisiciones
            </a>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
            <div class="dropdown-divider"></div>
        </div>
    </div>
    
</div>

