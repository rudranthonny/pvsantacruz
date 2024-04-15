@extends('adminlte::page')

@section('title', 'Tablero')

@section('content_header')
    <h1></h1>

@stop

@section('content')
    @livewire('reporte-general')
    @livewireScripts
@stop

@section('css')
    @livewireStyles
    <link href="{{ asset('css/css_bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('js/jquery-ui-1.13.1/jquery-ui.min.css')}}">
    <style>
        .select2-container .select2-selection--single {
            height: 50px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 48px;
        }

        .select2-container--default .select2-selection--single {
            padding: 0.75rem .75rem;
        }
        ul.ui-autocomplete { z-index: 1100;}


    </style>
@stop

@section('js')
    <script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui-1.13.1/jquery-ui.min.js')}}"></script>
    <script>
        window.Livewire.on('ejecutar_consulta_barra',general => {
            Highcharts.chart('model-grafico',
            {
                chart: {
                    type: 'column'
                },
                title: {
                    text: general[0][0],
                    align: 'left'
                },
                xAxis: {
                    categories: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado','Domingo'],
                    crosshair: true,
                    accessibility: {
                        description: 'Countries'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '1000 Quetzales (Q)'
                    }
                },
                tooltip: {
                    valueSuffix: ' (1000 Q)'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [
                    {
                        name: 'Ventas',
                        data: general[0][1],
                    },
                    {
                        name: 'Compras',
                        data: general[0][2],
                    }
                ]
            });

            Highcharts.chart('model-grafico2',
            {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: general[0][3],
                    align: 'left'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        borderWidth: 2,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b><br>{point.y}',
                            distance: 20
                        }
                    }
                },
                series: [{
                    // Disable mouse tracking on load, enable after custom animation
                    enableMouseTracking: false,
                    animation: {
                        duration: 2000
                    },
                    colorByPoint: true,
                    data: general[0][4],
                }]
            });
        });
    </script>
@stop
