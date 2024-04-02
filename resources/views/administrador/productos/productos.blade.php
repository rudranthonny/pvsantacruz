@extends('adminlte::page')

@section('title', 'Gestionar Productos')

@section('plugins.Select2', true)

@section('content_header')
    <h1></h1>
@stop

@section('content')
    @livewire('gestionar-productos')
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
        ul.ui-autocomplete { z-index: 1100;}


    </style>
@stop

@section('js')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui-1.13.1/jquery-ui.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#simbologia').select2();
        });
    </script>
     <script type="text/javascript">
        window.Livewire.on('activar_buscador_marca', marca_id =>
        {
                $('#buscar_marca').autocomplete({
                source: function(request,response){
                    $.ajax({
                    url: '{{route("search.buscar_marca")}}',
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
                        $('#buscar_marca_oculto').val('');
                        $('#buscar_marca_oculto').val(ui.item.id);
                        $('#buscar_marca_oculto')[0].dispatchEvent(new Event('input'));
                        $('#buscar_marca').val(ui.item.name);
                        }, 750);
                    }
                    });
        });

        window.Livewire.on('activar_buscador_categoria', categoria_id =>
        {
            $('#buscar_categoria').autocomplete({
            source: function(request,response){
                $.ajax({
                url: '{{route("search.buscar_categoria")}}',
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
                    $('#buscar_categoria_oculto').val('');
                    $('#buscar_categoria_oculto').val(ui.item.id);
                    $('#buscar_categoria_oculto')[0].dispatchEvent(new Event('input'));
                    $('#buscar_categoria').val(ui.item.name);
                    }, 750);
                }
                });
        });
     </script>
@stop
