@extends('adminlte::page')

@section('title', 'Reporte Logs')

@section('content_header')
    <center>
        <h1>Reporte Logs</h1>
    </center>
@stop
@section('content')
    @livewire('reporte-logs')
    @livewireScripts   
@stop

@section('css')
        <link href="{{ asset('css/css_bootstrap.min.css') }}" rel="stylesheet">
@stop

@section('js')
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@stop