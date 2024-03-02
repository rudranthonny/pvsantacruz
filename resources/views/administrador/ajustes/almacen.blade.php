@extends('adminlte::page')

@section('title', 'Moneda')

@section('content_header')
    <h1>Moneda</h1>
@stop

@section('content')
    @livewire('gestionar-almacen')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
