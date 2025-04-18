@extends('adminlte::page')

@section('title', 'Gestionar Unidades')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    @livewire('gestionar-reservas-reporte')
@stop

@section('css')
    <link href="{{ asset('css/css_bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
@stop

@section('js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
@stop
