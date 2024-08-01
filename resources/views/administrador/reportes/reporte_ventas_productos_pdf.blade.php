<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ganacias por Producto</title>
    <link href="{{asset('css/estilo_reporte.css')}}" rel="stylesheet" >
</head>
<body class="m-1 fs-12">
    <table>
        <tr>
            <td colspan="8" style="text-align:center;">{{$configuracion->name}}</td>
        </tr>
        <tr>
            <td colspan="8" style="text-align:center;">Reporte de Ganacias por Producto  {{$finicio}} al {{$ffinal}}</td>
        </tr>
    </table>
    <table class="table">
        <thead>
            <tr class="table-dark">
                <th style="text-align:center;border:solid 1px #0a0a0a;background-color: #9b9b9b;">Producto</th>
                <th style="text-align:center;border:solid 1px #0a0a0a;background-color: #9b9b9b;">Almacen</th>
                <th style="text-align:center;border:solid 1px #0a0a0a;background-color: #9b9b9b;">Cantidad</th>
                <th style="text-align:center;border:solid 1px #0a0a0a;background-color: #9b9b9b;">Ventas</th>
                <th style="text-align:center;border:solid 1px #0a0a0a;background-color: #9b9b9b;">Descuentos</th>
                <th style="text-align:center;border:solid 1px #0a0a0a;background-color: #9b9b9b;">Costo</th>
                <th style="text-align:center;border:solid 1px #0a0a0a;background-color: #9b9b9b;">Ganacia</th>
            </tr>
        </thead>
        <tbody class="table-secondary">
            @foreach ($nombre_productos as $key => $npproducto)
                @php
                $total_ventas = 0;
                $total_costo = 0;
                $total_descuento = 0;
                $total_cantidad = 0;
                    foreach ($consulta_ventas->where('producto_id',$key) as $key2 => $ven)
                    {
                        $total_cantidad = $total_cantidad+$ven->producto_cantidad;
                        $total_ventas = $total_ventas+$ven->producto_cantidad*$ven->producto_precio;
                        $total_costo = $total_costo+$ven->producto_cantidad*$ven->producto_compra;
                        $total_descuento = $total_descuento + $ven->producto_descuento;
                    }
                @endphp
            <tr>
                <td style="border: solid 1px black;text-align: center;">{{$nombre_productos[$key]['nombre']}}</td>
                <td style="border: solid 1px black;text-align: center;">
                    @if ($salmacen == '')
                        Todos
                    @elseif($salmacen <> '')
                        @if (isset($almacens->where('id',$salmacen)->first()->nombre))
                            {{$almacens->where('id',$salmacen)->first()->nombre}}
                        @endif
                    @endif
                </td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$total_cantidad}}</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$total_ventas}}</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$total_descuento}}</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$total_costo}}</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.($total_ventas-$total_costo-$total_descuento)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

