<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">-->
      <span class="brand-text font-weight-light ">Biblioteca</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="{{ route('home') }}" class="d-block">Inicio</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview {{ ( request()->is('biblioteca/*') ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( request()->is('biblioteca/*') ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Biblioteca
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('buscar.disponible') }}" class="nav-link {{ ( request()->is('biblioteca/busqueda/*') ) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Busqueda Para Prestamo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Prestar libro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver Deudores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penalizaciones</p>
                </a>
              </li>
            </ul>
          </li>
          <!--inventario-->
          <li class="nav-item has-treeview {{ ( request()->is('inventario/*') ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( request()->is('inventario/*') ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Inventario
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('biblioteca') }}" class="nav-link {{ ( request()->is('inventario/bibliotecas') ) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bibliotecas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('busqueda') }}" class="nav-link {{ ( request()->is('inventario/ingreso/libro') ) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ingreso de libro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('lista.ejemplares') }}" class="nav-link {{ ( request()->is('inventario/lista/ejemplares') ) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista de ejemplares</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('imprimir.all') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Códigos de barra</p>
                </a>
              </li>
            </ul>
          </li>
          <!--aportes-->
          <li class="nav-item has-treeview {{ ( request()->is('aportes/*') ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( request()->is('aportes/*') ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Aportes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('aportes.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aportes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('areas')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Item 2</p>
                </a>
              </li>
            </ul>
          </li>
          <!--adquisiciones-->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Adquisiciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sugerir Adquisición</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver sugerencias</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
