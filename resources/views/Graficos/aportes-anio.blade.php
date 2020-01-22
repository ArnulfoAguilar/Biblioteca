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
            <div id="container3" style="width:100%; height:400px;"></div>
        </div>
    </div>
</div>

<div class="container"></div>

<script type="text/javascript" charset="utf8" src="/js/highcharts.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

       var options= {
            chart: {
                renderTo: 'container3',
                type: 'column'
            },
            title: {
                text: 'Aportes al año'
            },
            subtitle: {
                text: 'Cantidad de aportes realizados (aprobados y pendientes) por cada area al año'
            },
            xAxis: {
                categories: [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Cantidad'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                
            ]
        };


        var analytics = <?php echo $lista; ?>;
        var areas = <?php echo $areas; ?>;
        
        for(i=0; i<areas.length; i++){
            console.log(areas[i]);
            options.series.push( {name: areas[i] });
        }
        for(i=0; i<analytics.length; i++){
            console.log(analytics[i]);
            options.series[i].data = analytics[i] ;
        }

        chart = new Highcharts.Chart(options);

    });

</script>

@endsection


