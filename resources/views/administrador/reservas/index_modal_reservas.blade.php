@extends('adminlte::page')

@section('title', 'Gestionar Reservas')

@section('content_header')
    <h1></h1>
    @livewireStyles
@stop

@section('content')
    @yield('content')
@stop

@section('css')
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/hotel_estilo.css')}}" rel="stylesheet">
    <link href="{{ asset('css/css_bootstrap.min.css') }}" rel="stylesheet">
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
    <script src='{{asset('js/fullcalendar/index.global.min.js')}}'></script>
    <script src='{{asset('js/fullcalendar/locales-all.global.min.js')}}'></script>
    <script src="{{asset('js/select2/index.global.min.js')}}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
     <!--full calendar-->
     

     <script type="text/javascript">
        Livewire.on('cerrar_modal_agenda', reservacion => {
            actualizar_calendario();
            ventana = document.getElementById('cerrar_ventana_modal_reserva').click();
        });

        Livewire.on('general_actualizar_calendario', reservacion => {
            actualizar_calendario();
            ventana = document.getElementById('cerrar_modal_agenda_a').click();
        });

        Livewire.on('error_cambio_estado', () => {
            Swal.fire({
                position: "center-center",
                icon: "error",
                title: "Recuerda que el cliente debe estar al día en sus pagos",
                showConfirmButton: false,
                timer: 1500
            });
        });

        Livewire.on('error_cancelacion_reserva', () => {
            Swal.fire({
                position: "center-center",
                icon: "error",
                title: "No se puede cancelar la reserva",
                showConfirmButton: false,
                timer: 1500
            });
        });

        Livewire.on('success', mensaje => {
            Swal.fire({
                position: "center-center",
                icon: "success",
                title: mensaje,
                showConfirmButton: false,
                timer: 1500
            });
        });

        Livewire.on('error', mensaje => {
            Swal.fire({
                position: "center-center",
                icon: "error",
                title: mensaje,
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
@stop
