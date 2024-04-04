@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1><center></center></h1>
@livewireStyles
@stop

@section('content')
@livewire('cambiar-password')

@stop
@section('css')
    <link href="{{asset('css/css_bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
    @livewireScripts
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop
