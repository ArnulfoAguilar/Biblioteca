@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card d-flex justify-content-around">
                <div class="card-status card-status-left bg-blue text-center"></div>
                <div class="card-header text-center">
                    <h3 class="card-title ">
                        Biblioteca Virtual &nbsp&nbsp | &nbsp&nbsp Colegio Español Padre Arrupe
                    </h3>
                    
                </div>
                <div class="card-body text-center">

                        
                        <div class="text-center">
                                <h4>
                                    <a href="#">
                                        ¡Bienvenido al Sistema Informatico de biblioteca del Colegio Español Padre Arrupe!

                                    </a>
                                </h4>
                                <div class="text-muted text-justify" >
                                        MISIÓN:
                                        <br>
                                        El Colegio Español Padre Arrupe se propone impartir una enseñanza de  calidad integral, atendiendo a las características socioafectivas y económicas de sectores vulnerables de la población salvadoreña.
                                        
                                        Con este fin, el Colegio respeta y defiende la originalidad de cada alumno y alumna, las distintas formas y caminos por las que cada individuo obtiene su desarrollo y alcanza su madurez. 
                                        <br>
                                        <br>
                                        VISIÓN:
                                        <br>
                                        Nuestra institución quiere ser un centro de interés, de atracción y comunicación para que todos y todas los que en ella se integren encuentren lo necesario para un desarrollo integral.
                                </div>
                        </div>
                </div>
            </div>

           
            <div class="card text-center">
                <div class="card-header ">Enlaces de interés</div>

                <div class="card-body ">
                        <div class="row d-flex justify-content-around">
                                <div class="card border-primary mb-3 mr-2 ml-2" style="max-width: 18rem;">
                                    <div class="card-header">Prestamos bibliotecarios</div>
                                    <div class="card-body text-primary">
                                        {{-- <h5 class="card-title">Primary card title</h5> --}}
                                        <p class="card-text">
                                            Podrá realizar préstamos de los libros que necesite y además ver aportes creados por estudiantes
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{route('home')}}">Ir <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="card border-primary mb-3 mr-2 ml-2" style="max-width: 18rem;">
                                    <div class="card-header">Portal Institucional</div>
                                    <div class="card-body text-primary">
                                        {{-- <h5 class="card-title">Primary card title</h5> --}}
                                        <p class="card-text">
                                            Acá podrá encontrar información de la institución, horarios, manuales y mucho más
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="http://www.colegiopadrearrupe.org/portal/">Ir <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="card border-success mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Clínica Asistencial Padre Arrupe</div>
                                    <div class="card-body text-primary">
                                        {{-- <h5 class="card-title">Primary card title</h5> --}}
                                        <p class="card-text">
                                                Clínica asistencial al servicio de la población en general. Excelencia en el servicio, equipo de última generación y precios económicos
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="https://www.facebook.com/clinicapadrearrupe/">Ir <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                        </div>
                </div>
            

               
            </div>
            
            <div class="card">
                <div class="card-header">Ubicación en el mapa</div>

                <div class="card-body">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15503.90285546188!2d-89.15949529289047!3d13.719920159894182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f63375ba756944d%3A0xe8453b4516ba5467!2sColegio%20Espa%C3%B1ol%20Padre%20Arrupe!5e0!3m2!1ses!2ssv!4v1574475239221!5m2!1ses!2ssv" class="col-12" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

                </div>
            

               
            </div>
            
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header">Más enlaces</div>
                <div class="card-body">
                        <div class="embed-responsive embed-responsive-1by1">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/rqa13n46Pk8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                              </div>
                    <div class="card"></div>

                    <div class="embed-responsive embed-responsive-1by1">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/yTTZN9cfLHk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>

        
        
    </div>
</div>

@endsection