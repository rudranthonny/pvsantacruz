@extends('adminlte::page')

@section('title', 'Moneda')

@section('content_header')
    <h1>Moneda</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <h3>Aqui va ir las monedas</h3>
    @foreach (\App\Models\Moneda::all() as $moneda)
        <table>
            <tr>
                <td><p>{{$moneda->codigo_moneda}}</p></td>
                <td><p>{{$moneda->nombre_moneda}}</p></td>
                <td><p>{{$moneda->simbolo}}</p></td>
            </tr>
        </table>
    @endforeach
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
