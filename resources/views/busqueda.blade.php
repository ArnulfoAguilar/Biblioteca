<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<!-- Navbar -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
  
    <title>Colegio Padre Arrupe | @yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="{{url('css/app.css')}}">
      <!-- CSRF Token >
      <meta name="csrf-token" content="{{ csrf_token() }}"-->
      @yield('cssextra')
  </head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.adminlte.navbar')

  <!--Sidebar-->
  @include('layouts.adminlte.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('Encabezado')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            @yield('breadcrumbs')
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div id="app">
            <busqueda-api></busqueda-api>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer d-print-none">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Grupo de tesis 01
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="https://www.ues.edu.sv/">Universidad de El Salvador</a>.</strong> Todos los derechos reservados.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="{{url('js/app.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
        $('#notificaciones').click(function() { 
          var _token = $('input[name="_token"]').val();     
          $.ajax({
              url: "{{ route('marcar.leidas') }}",
              method: "POST",
              data: {
                  // buscar: buscar,
                  _token: _token,
              },
              success: function (result) {
                  console.log("Notificaciones marcadas como leidas")
                  location.reload();
                  // $('#reemplazar').html(result);
              },
          })
       });
  });
  </script>
{{-- @include('layouts.scripts') --}}
@yield('jsExtra')
{{-- {!! Toastr::render() !!} --}}
</body>
</html>



