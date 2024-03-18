@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    @livewire('gestionar-usuarios')
@stop

@section('css')
    <link href="{{ asset('css/css_bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
@stop

@section('js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script>
        Livewire.on('cerrar_modal_cliente', reservacion => {
            ventana = document.getElementById('cerrar_modal_cliente_x').click();
        });
    </script>
@stop
