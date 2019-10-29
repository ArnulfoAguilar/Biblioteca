@extends('layouts.adminLTE')

@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class=" float-right">
                    <form class="form-inline" action="{{route('graficos.aportes.anio')}}" method="GET">
                        <input type="number" min="2019" class="form-control mb-2 mr-sm-2" name="anio" placeholder="--Filtro por Año--" value="{{$anio ? $anio : '' }}">
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="card-body" id="barchart_material" style="width: 900px; height: 600px;"></div>
        </div>
    </div>
</div>

<div class="container">
        
    {{-- <div class="col-md-12" id="chart_div"></div> --}}

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
</script>

<script type="text/javascript">
var analytics = <?php echo $lista; ?>;
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.arrayToDataTable(
            analytics
        );

      var options = {
        chart: {
          title: 'Aportes del año',
          subtitle: 'Mostrados por área',
        },
        bars: 'horizontal' // Required for Material Bar Charts.
      };

      var chart = new google.charts.Bar(document.getElementById('barchart_material'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>

@endsection
