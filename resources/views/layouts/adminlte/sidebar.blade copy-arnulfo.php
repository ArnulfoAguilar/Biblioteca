<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('home') }}" class="brand-link">
    <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">-->
    <span class="brand-text font-weight-light ">Página Principal</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                
          {{-- admisnistracion --}}
          @if (Auth::user()->rol->id == 1 )
          <li class="nav-item has-treeview {{ ( request()->is('administracion/*') ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( request()->is('administracion/*') ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Administración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{route('asignar.roles')}}" class="nav-link {{ ( request()->is('administracion/asignar/roles') ) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Asignar rol</p>
                  </a>
                </li>
              @endif
  
              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{route('asignar.comites')}}"
                    class="nav-link {{ ( request()->is('administracion/asignar/comites') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Asignar departamento</p>
                  </a>
                </li>
              @endif
  
  
              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{route('calendario')}}" 
                    class="nav-link {{ ( request()->is('administracion/calendario') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Calendario</p>
                  </a>
                </li>
              @endif
  
              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{route('administracion.get.usuarios')}}" 
                    class="nav-link {{ ( request()->is('administracion/get/users') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Puntajes de usuarios</p>
                  </a>
                </li>
              @endif
            </ul>
          </li>
        @endif         
       
             <!--aportes-->
                @if (Auth::user()->rol->id == 1 || Auth::user()->rol->id == 2 || Auth::user()->rol->id == 3 || Auth::user()->rol->id == 4)
                <li class="nav-item has-treeview {{ ( request()->is('aportes') || request()->is('GetMisAportesAprobados') || request()->is('GetMisAportesSinAprobar')|| request()->is('GetVistaAportesDirector') || request()->is('GetAportesArea') ) ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link  {{ ( request()->is('aportes') || request()->is('GetMisAportesAprobados') || request()->is('GetMisAportesSinAprobar')|| request()->is('GetVistaAportesDirector') || request()->is('GetAportesArea') ) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-graduation-cap"></i>
                    <p>
                      Aportes
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                    <a href="{{route('aportes.index')}}" class="nav-link {{ ( request()->is('aportes') ) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Aportes de la comunidad</p>
                      </a>
                    </li>
      
      
                    <li class="nav-item">
                      <a href="{{route('aportes.GetMisAportesAprobados')}}" class="nav-link {{ ( request()->is('GetMisAportesAprobados') ) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Mis Aportes Aprobados</p>
                      </a>
                    </li>
      
      
                    <li class="nav-item">
                      <a href="{{route('aportes.GetMisAportesSinAprobar')}}" class="nav-link {{ ( request()->is('GetMisAportesSinAprobar') ) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Mis Aportes Sin Aprobar</p>
                      </a>
                    </li>
      
                    @if (Auth::user()->rol->id == 1 )
                    <li class="nav-item">
                      <a href="{{route('aportes.GetVistaAportesDirector')}}" class="nav-link {{ ( request()->is('GetVistaAportesDirector') ) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Todos los aportes</p>
                      </a>
                    </li>
                    @endif
      
                    @if (Auth::user()->rol->id == 4 )
                    <li class="nav-item">
                      <a href="{{route('aportes.GetAportesArea')}}" class="nav-link {{ ( request()->is('GetAportesArea') ) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Aportes del área</p>
                      </a>
                    </li>
                    @endif
                  </ul>
                </li>
              @endif
             
        @if (Auth::user()->rol->id == 1 || Auth::user()->rol->id == 2 || Auth::user()->rol->id == 3 || Auth::user()->rol->id == 4)
          <li class="nav-item has-treeview {{ ( request()->is('biblioteca/*') ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( request()->is('biblioteca/*') ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-atlas"></i>

              <p>
                Biblioteca
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              @if (Auth::user()->rol->id == 1 || Auth::user()->rol->id == 2 || Auth::user()->rol->id == 3 || Auth::user()->rol->id == 4)
                <li class="nav-item">
                  <a href="{{ route('realizar.prestamo') }}" class="nav-link {{ ( request()->is('biblioteca/realizar/prestamo') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Realizar Préstamo</p>
                  </a>
                </li>
              @endif
              
              @if (Auth::user()->rol->id == 1 )
              <li class="nav-item">
                <a href="{{route ('prestamos')}}" class="nav-link {{ ( request()->is('biblioteca/prestamo/lista') ) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver Préstamos</p>
                </a>
              </li>
              @endif
              
              @if (Auth::user()->rol->id == 1 || Auth::user()->rol->id == 2 || Auth::user()->rol->id == 3 || Auth::user()->rol->id == 4)
              <li class="nav-item">
              <a href="{{route ('mis.prestamos')}}" class="nav-link {{( request()->is('biblioteca/mis/prestamos') ) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mis Préstamos</p>
                </a>
              </li>
              @endif


              @if (Auth::user()->rol->id == 1)
              <li class="nav-item">
                <a href="{{route ('penalizaciones.lista')}}" class="nav-link {{( request()->is('biblioteca/penalizaciones') ) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penalizaciones</p>
                </a>
              </li>
              @endif

              @if (Auth::user()->rol->id == 1)
              <li class="nav-item">
                <a href="{{route ('biblioteca.ver.solvencia')}}" class="nav-link {{( request()->is('biblioteca/solvencias/*') ) ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Extender Solvencia</p>
                </a>
              </li>
              @endif
              
            </ul>
          </li>
        @endif

        {{-- Catalogos --}}
        @if (Auth::user()->rol->id == 1)
          <li class="nav-item has-treeview {{ ( request()->is('catalogos/*') ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( request()->is('catalogos/*') ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Catálogos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{route('roles')}}" class="nav-link {{ ( request()->is('catalogos/roles') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista de roles</p>
                  </a>
                </li>
              @endif
    
              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{route('comites')}}" class="nav-link {{ ( request()->is('catalogos/comites') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista de departamentos</p>
                  </a>
                </li>
              @endif

              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{route('palabras.prohibidas')}}"
                    class="nav-link {{ ( request()->is('catalogos/palabras-prohibidas') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Palabras prohibidas </p>
                  </a>
                </li>
              @endif

              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{route('tipos.penalizaciones')}}"
                    class="nav-link {{ ( request()->is('catalogos/tipos/penalizaciones') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tipos de penalizaciones </p>
                  </a>
                </li>
              @endif

              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{route('Configuracion')}}"
                    class="nav-link {{ ( request()->is('catalogos/Configuracion') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Configuraciones </p>
                  </a>
                </li>
              @endif

              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{route('registro.actividad')}}"
                    class="nav-link {{ ( request()->is('catalogos/registro/actividad') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Registros de actividad </p>
                  </a>
                </li>
              @endif
            </ul>
          </li>
        @endif


        {{-- Catalogos --}}
        @if (Auth::user()->rol->id == '1' )
          <li class="nav-item has-treeview {{ ( request()->is('graficos/*') ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( request()->is('graficos/*') ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Gráficos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @if (Auth::user()->rol->id == '1' )
                <li class="nav-item">
                  <a href="{{route('graficos.aportes')}}"
                    class="nav-link {{ ( request()->is('graficos/aportes') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Aportes por área</p>
                  </a>
                </li>
              @endif

              @if (Auth::user()->rol->id == '1' )
                <li class="nav-item">
                  <a href="{{route('graficos.aportes.anio')}}"
                    class="nav-link {{ ( request()->is('graficos/aportes/anio') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Aportes al año</p>
                  </a>
                </li>
              @endif
                
            </ul>
          </li>
        @endif
        <!--inventario-->
        @if (Auth::user()->rol->id == 1)
          <li class="nav-item has-treeview {{ ( request()->is('inventario/*') ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( request()->is('inventario/*') ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>

              <p>
                Inventario
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{ route('biblioteca') }}" class="nav-link {{ ( request()->is('inventario/bibliotecas') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bibliotecas</p>
                  </a>
                </li>
              @endif

              @if (Auth::user()->rol->id == 1 )
              <li class="nav-item">
                <a href="{{ route('imprimir') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Códigos de barra</p>
                </a>
              </li>
            @endif

              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{ route('inventario.estantes') }}" class="nav-link {{ ( request()->is('inventario/estantes') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Estantes</p>
                  </a>
                </li>
              @endif

              @if (Auth::user()->rol->id == 'X' )
                <li class="nav-item">
                  <a href="{{ route('busqueda') }}" class="nav-link {{ ( request()->is('inventario/ingreso/libro') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ingreso de libro</p>
                  </a>
                </li>
              @endif

              @if (Auth::user()->rol->id == 1 )
                <li class="nav-item">
                  <a href="{{ route('lista.ejemplares') }}" class="nav-link {{ ( request()->is('inventario/lista/ejemplares') ) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista de ejemplares</p>
                  </a>
                </li>
              @endif
              @if (Auth::user()->rol->id == 1 )
              <li class="nav-item">
                <a href="{{route('inventariar')}}" class="nav-link {{ ( request()->is('/inventariar') ) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inventariar final período</p>
                </a>
              </li>
            @endif
            </ul>
          </li>
        @endif

         <!--Reportes-->
         @if (Auth::user()->rol->id == 1 || Auth::user()->rol->id == 3 || Auth::user()->rol->id == 4)
         <li class="nav-item has-treeview {{ ( request()->is('Reportes/*') ) ? 'menu-open' : '' }}">
           <a href="#" class="nav-link {{ ( request()->is('Reportes/*') ) ? 'active' : '' }}">
             <i class="nav-icon fas fa-atlas"></i>
 
             <p>
                Reportes estadísticos
             </p>
           </a>
 
         </li>
       @endif

           <!--adquisiciones-->
        @if (Auth::user()->rol->id == 1 || Auth::user()->rol->id == 3 || Auth::user()->rol->id == 4)
        <li class="nav-item has-treeview {{ ( request()->is('adquisicion/*') ) ? 'menu-open' : '' }}">
          <a href="{{route('adquisicion.lista')}}" class="nav-link {{ ( request()->is('adquisicion/*') ) ? 'active' : '' }}">
            <i class="nav-icon fas fa-atlas"></i>

            <p>
               Sugerencias de Adquisicion
            </p>
          </a>

        </li>
      @endif

        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>