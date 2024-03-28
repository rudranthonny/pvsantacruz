@extends('adminlte::page')

@section('title', 'Gestionar Productos')

@section('content_header')
    <h1></h1>
    @livewireStyles
@stop

@section('content')
    @livewire('imprimir-codigo')
@stop

@section('css')
    <link href="{{ asset('css/css_bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <link rel="stylesheet" href="{{asset('js/jquery-ui-1.13.1/jquery-ui.min.css')}}">
    <style>

        .barcodea4 {
            border: 1px solid #ccc;
            display: block;
            margin: 10px auto;
            page-break-after: always;

            height: 11.6in;
            padding: 0.1in 0 0 0.1in;
            width: 8.25in;
        }

        .barcode_non_a4 {
            height: 10.3in;
            padding-top: 0.1in;
            width: 8.45in;
        }

        .barcode_non_a4, .barcodea4 {
            border: 1px solid #ccc;
            display: block;
            margin: 10px auto;
            page-break-after: always;
        }

        .barcode_non_a4 .barcode-name, .barcodea4 .barcode-name
        {
            display: block;
        }

        .barcodea4 .barcode-item {
            border: 1px dotted #ccc;
            display: block;
            float: left;
            font-size: 12px;
            line-height: 14px;
            overflow: hidden;
            text-align: center;
            text-transform: uppercase;
        }

        .barcode_non_a4 .barcode-item {
            border: 1px dotted #ccc;
            display: block;
            float: left;
            font-size: 12px;
            line-height: 14px;
            overflow: hidden;
            text-align: center;
            text-transform: uppercase;
        }

        .barcodea4 .style40 {
            height: 1.003in;
            margin: 0 0.07in;
            padding-top: 0.05in;
            width: 1.799in;
        }

        .barcode_non_a4 .style30 {
            height: 1in;
            margin: 0 0.07in;
            padding-top: 0.05in;
            width: 2.625in;
        }

        .barcodea4 .style24 {
            height: 1.335in;
            margin-left: 0.079in;
            padding-top: 0.05in;
            width: 2.48in;
        }

        .barcode_non_a4 .style20 {
            height: 1in;
            margin: 0 0.1in;
            padding-top: 0.05in;
            width: 4in;
        }

        .barcodea4 .style18 {
            font-size: 13px;
            height: 1.835in;
            line-height: 20px;
            margin-left: 0.079in;
            padding-top: 0.05in;
            width: 2.5in;
        }

        .barcode_non_a4 .style14 {
            height: 1.33in;
            margin: 0 0.1in;
            padding-top: 0.1in;
            width: 4in;
        }

        .barcodea4 .style12 {
            font-size: 14px;
            height: 2.834in;
            line-height: 20px;
            margin-left: 0.079in;
            padding-top: 0.05in;
            width: 2.5in;
        }

        .barcode_non_a4 .style10 {
            font-size: 14px;
            height: 2in;
            line-height: 20px;
            margin: 0 0.1in;
            padding-top: 0.1in;
            width: 4in;
        }

    </style>
@stop

@section('js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui-1.13.1/jquery-ui.min.js')}}"></script>
    <script type="text/javascript">
        window.Livewire.on('advertencia_almacen', () =>
        {
            Swal.fire({
            position: "center-center",
            icon: "warning",
            title: "Elegir un Almacen para realizar la compra",
            showConfirmButton: false,
            timer: 1500
            });
        });

        window.Livewire.on('activar_buscador_producto', almacen_id =>
        {
            $('#buscar_producto').autocomplete({
            source: function(request,response){
                $.ajax({
                url: '{{route("search.buscar_productos_compra2")}}',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data){
                    response(data)
                }
            });
            },
            minLength: 3,
            select: function(event,ui)
                {
                    setTimeout(() => {
                    $('#buscar_producto_oculto').val('');
                    $('#buscar_producto_oculto').val(ui.item.codigo);
                    $('#buscar_producto_oculto')[0].dispatchEvent(new Event('input'));
                    $('#buscar_producto').val('');
                    }, 750);
                }
                });
        });
    </script>
@stop
