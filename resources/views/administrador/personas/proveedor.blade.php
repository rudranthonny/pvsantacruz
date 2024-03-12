@extends('adminlte::page')

@section('title', 'Proveedor')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    @livewire('gestionar-proveedor')
@stop

@section('css')
    <link href="{{ asset('css/css_bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
@stop

@section('js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script>
        Livewire.on('cerrar_modal_proveedor', reservacion => {
            ventana = document.getElementById('cerrar_modal_proveedor_x').click();
        });
    </script>
@stop
