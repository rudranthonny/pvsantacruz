@extends('adminlte::page')

@section('title', 'Gestionar Marcas')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    @livewire('gestionar-marcas')
@stop

@section('css')
    <link href="{{ asset('css/css_bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
@stop

@section('js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script>
         Livewire.on('cerrar_modal_moneda', reservacion => {
            ventana = document.getElementById('cerrar_modal_moneda_x').click();
        });
    </script>
@stop
