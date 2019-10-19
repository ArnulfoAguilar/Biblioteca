@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <section class="content">
            <div class="container-fluid">
              <div class="row">
                <biografia-sidebar></biografia-sidebar>
                <biografia-aportes></biografia-aportes>
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
</div>
@endsection
