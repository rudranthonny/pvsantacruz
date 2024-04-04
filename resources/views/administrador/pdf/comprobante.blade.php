<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            font-size: 12px;
            margin-left: 2.5px;
            margin-right: 2.5px;
            margin-top: 2.5px;
        }
    </style>
</head>

<body>
    <center>
    <img src="{{ asset($configuracion->logo) }}" alt="" srcset="" width="136px;">
    </center>
    <center>
        <h3 style="font-size: 24px;">{{$configuracion->name}}</h3>
    </center>
    <table>
        <tbody>
            <tr>
                <td>
                    <b>Fecha :</b> {{$posventa->created_at}}
                </td>
            </tr>
            <tr>
                <td><b>Dirección : </b> {{$configuracion->direccion}}</td>
            </tr>
            <tr>
                <td>
                   <b> Cliente :</b> {{$posventa->cliente_name }}
                </td>
            </tr>
            <tr>
                <td>
                    <b> Almacen :</b> {{$posventa->almacen_name }}
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <table class="table" width="100%">
        <tbody>
            @foreach ($posventa->posventadetalles as $detalle)
                <tr>
                    <td colspan="2" style="text-align: left;">{{strtoupper($detalle->producto_nombre)}}</td>
                </tr>
                <tr>
                    <td style="text-align: left;border-bottom: dashed 1px black;">
                        {{number_format($detalle->producto_cantidad,2)}} x {{number_format($detalle->producto_precio,2)}}
                    </td>
                    <td style="text-align: right;border-bottom: dashed 1px black;">
                        {{number_format($detalle->producto_importe,2)}}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;border-bottom: dashed 1px black;" scope="col"><b>Total</b></td>
                    <td style="text-align: right;border-bottom: dashed 1px black;"><b>{{$configuracion->moneda->simbolo}} {{number_format($detalle->producto_importe,2)}}</b></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table class="table" width="100%">
        <thead class="table-light">
            <tr>
                <th scope="col" style="text-align: left;border-bottom: dashed 1px black;background-color: #21252885"><b>Pagado Con:</b></th>
                <th scope="col" style="text-align: center;border-bottom: dashed 1px black;background-color: #21252885"><b>Monto:</b></th>
                <th scope="col" style="text-align: right;border-bottom: dashed 1px black;background-color: #21252885"><b>Cambiar:</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: left">Contado</td>
                <td style="text-align: center">{{number_format($posventa->cantidad_recibida,2)}}</td>
                <td style="text-align: right">{{number_format($posventa->cambio,2)}}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <center>
    <span style="text-align: center;"><b>Gracias Por Su Compra, Vuelva Pronto.</b></span><br>
    <span style="text-align: center;"><b>SL_{{$posventa->id}}</b></span><br>
    <table width='100%'>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>{!! DNS1D::getBarcodeHTML("SL_".$posventa->id,'C128') !!}</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </table>
    </center>
</body>

</html>
