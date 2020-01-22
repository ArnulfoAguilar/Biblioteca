@extends('layouts.adminLTE')

@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class=" float-right">
                    <form class="form-inline" action="{{route('graficos.aportes')}}" method="GET">
                        <input type="date" class="form-control mb-2 mr-sm-2" name="fecha_i" placeholder="Desde" value="{{$fecha_i ? $fecha_i : '' }}">
                        <input type="date" class="form-control mb-2 mr-sm-2" name="fecha_f" placeholder="Hasta" value="{{$fecha_f ? $fecha_f : '' }}">
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="card-body" id="chart_div"></div>
            <div id="container3" style="width:100%; height:400px;"></div>
        </div>
    </div>
</div>

<div class="container">
</div>

<script type="text/javascript" charset="utf8" src="/js/highcharts.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var analytics = <?php echo $lista; ?>;
        var options={
            chart: {
                renderTo: 'container3',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Aportes por area'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Area',
                colorByPoint: true,
                data: []
            }]
        };
        for(i=1; i<analytics.length; i++){
            options.series[0].data.push( {name: analytics[i][0], y:analytics[i][1] } );
        }

        chart = new Highcharts.Chart(options);

    });

</script>

@endsection
