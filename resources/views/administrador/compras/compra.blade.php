@extends('adminlte::page')

@section('title', 'Gestionar Compras')

@section('content_header')
    <h1></h1>
    @livewireStyles
@stop

@section('content')
    @livewire('gestionar-compras')
@stop

@section('css')
    <link href="{{ asset('css/css_bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
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
        ul.ui-autocomplete {
            z-index: 1100;
        }
    </style>
@stop

@section('js')
    @livewireScripts
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui-1.13.1/jquery-ui.min.js')}}"></script>
    <script type="text/javascript">
        window.Livewire.on('activar_buscador_producto', almacen_id =>
        {
            $('#buscar_producto').autocomplete({
            source: function(request,response){
                $.ajax({
                url: '{{route("search.buscar_productos_compra")}}',
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
    </script>
@stop
