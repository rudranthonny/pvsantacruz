<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Compras</title>
    <link href="{{asset('css/estilo_reporte.css')}}" rel="stylesheet" >
</head>
<body class="m-1 fs-12">
    <div>
        <div class="col-12">
            <table>
                <tr>
                    <td>
                        <h1 class="modal-title fs-5" id="modalReporteCajaLabel">Reporte de Compras</h1><br>
                        <b>Compras en total : {{$compras->count()}}</b><br>
                        <b>Fecha Inicio :</b> {{$compras->first()->fecha}}<br>
                        <b>Fecha Final :</b>  {{$compras->sortByDesc('fecha')->first()->fecha}}
                    </td>
                    <td><img src="{{asset($configuracion->logo)}}" alt="" width="128px"></td>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th class="encabezado-dark" style="width:100px;">Fecha</th>
                    <th class="encabezado-dark" style="width:100px;">Referencia</th>
                    <th class="encabezado-dark" style="width:120px;">Proveedor</th>
                    <th class="encabezado-dark" style="width:120px;">Almacen</th>
                    <th class="encabezado-dark" style="width:100px;">Estado</th>
                    <th class="encabezado-dark" style="width:80px;">Total</th>
                    <th class="encabezado-dark" style="width:80px;">Pagado</th>
                    <th class="encabezado-dark" style="width:80px;">Debido</th>
                    <th class="encabezado-dark" style="width:80px;">Estado de Pago</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($compras as $compra)
                    <tr>
                        <td class="encabezado-body">{{ $compra->fecha }}</td>
                        <td class="encabezado-body">{{ "COM_".$compra->id }}</td>
                        <td class="encabezado-body">{{ $compra->proveedor->name }}</td>
                        <td class="encabezado-body">{{ $compra->almacen->nombre }}</td>
                        <td class="encabezado-body">
                            @if ($compra->estado == 1)
                            <span class="badge text-bg-success">Recibido</span>
                            @elseif ($compra->estado == 2)
                            <span class="badge text-bg-primary">Pendiente</span>
                            @elseif ($compra->estado == 3)
                            <span class="badge text-bg-warning">Ordenado</span>
                            @endif
                        </td>
                        <td class="encabezado-body">{{ $configuracion->moneda->simbolo.$compra->total }}</td>
                        <td class="encabezado-body">{{ $configuracion->moneda->simbolo.$compra->pagado }}</td>
                        <td class="encabezado-body">{{ $configuracion->moneda->simbolo.$compra->debido }}</td>
                        <td class="encabezado-body">
                            @if ($compra->estado_pago == 1)
                            No Pagado
                            @elseif($compra->estado_pago == 2)
                            Pagado
                            @elseif($compra->estado_pago == 3)
                                Parcial
                            @endif
                        </td>
                    </tr>
                @empty
                @endforelse
                <tr>
                    <td colspan="5" style="background-color: black;color:white;text-align:center;">
                        Total
                    </td>
                    <td class="text-center table-success" style="text-align: center;">{{$configuracion->moneda->simbolo.$compras->sum('total')}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
