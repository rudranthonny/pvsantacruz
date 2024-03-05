@extends('adminlte::page')

@section('title', 'Gestionar Productos')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    @livewire('imprimir-codigo')
@stop

@section('css')
    <link href="{{ asset('css/css_bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <link rel="stylesheet" href="{{asset('js/jquery-ui-1.13.1/jquery-ui.min.css')}}">
@stop

@section('js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui-1.13.1/jquery-ui.min.js')}}"></script>
    <script type="text/javascript">
        window.Livewire.on('activar_buscador_producto', almacen_id =>
        {
            urlactual = window.location.host;
            $('#buscar_producto').autocomplete({
            source: function(request,response){
                $.ajax({
                url: 'http://'+urlactual+'/admin/search/'+proyecto_id+'/buscar_productos',
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
                    $('#buscar_empleado_proyecto').val('');
                    $('#buscar_empleado_proyecto').val(ui.item.dpi);
                    $('#buscar_empleado_proyecto')[0].dispatchEvent(new Event('input'));
                    }, 750);
                }
                });
        });
    </script>
@stop
