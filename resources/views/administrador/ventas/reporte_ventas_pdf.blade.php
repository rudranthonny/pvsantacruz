<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ventas</title>
    <link href="{{asset('css/estilo_reporte.css')}}" rel="stylesheet" >
</head>
<body class="m-1 fs-12">
    <div>
        <div class="col-12">
            @if (isset($posventas->first()->created_at))
            <table>
                <tr>
                    <td>
                        <h1 class="modal-title fs-5" id="modalReporteCajaLabel">Reporte de Ventas</h1><br>
                        @if (isset($bcajero->id))
                            <b>Cajero : {{$bcajero->lastname." ".$bcajero->name}}</b><br>
                        @endif
                        <b>Compras en total : {{$posventas->count()}}</b><br>
                        <b>Fecha Inicio :</b> {{$posventas->first()->created_at}}<br>
                        <b>Fecha Final :</b>  {{$posventas->sortByDesc('fecha')->first()->created_at}}
                    </td>
                    <td>
                        <img src="{{asset($configuracion->logo)}}" alt="" width="128px">
                    </td>
                </tr>
            </table>
            @endif
        </div>
    </div>
    @php $total2 = 0;@endphp
    @php 
        $total_devoluciones = 0; 
            foreach ($posventas as $pventa) {
                foreach ($pventa->devolucions as $dev) {
                    $total_devoluciones = $total_devoluciones+$dev->monto_pago;
            }
        }
    @endphp
    @if ($simple == false)
        <div>
            <table class="table table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th class="encabezado-dark" style="width:100px;">Fecha</th>
                        <th class="encabezado-dark" style="width:100px;">Almacen</th>
                        <th class="encabezado-dark" style="width:100px;">Comprobante</th>
                        <th class="encabezado-dark" style="width:100px;">Cliente</th>
                        <th class="encabezado-dark" style="width:100px;">Impuesto Porcentaje</th>
                        <th class="encabezado-dark" style="width:100px;">Impuesto</th>
                        <th class="encabezado-dark" style="width:100px;">Descuento</th>
                        <th class="encabezado-dark" style="width:100px;">Envio</th>
                        <th class="encabezado-dark" style="width:100px;">Costo Venta</th>
                        <th class="encabezado-dark" style="width:100px;">Total a Pagar</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total2 = 0;@endphp
                    @forelse ($posventas as $pventa)
                    <tr>
                        <td class="encabezado-body">{{ $pventa->created_at }}</td>
                        <td class="encabezado-body">{{ $pventa->almacen_name }}</td>
                        <td class="encabezado-body">{{ "SL_".$pventa->id }}</td>
                        <td class="encabezado-body">{{ $pventa->cliente_name }}</td>
                        <td class="encabezado-body">{{ $pventa->impuesto_porcentaje }}%</td>
                        <td class="encabezado-body">{{ $configuracion->moneda->simbolo.$pventa->impuesto_monto }}</td>
                        <td class="encabezado-body">{{ $configuracion->moneda->simbolo.$pventa->descuento }}</td>
                        <td class="encabezado-body">{{ $configuracion->moneda->simbolo.$pventa->envio }}</td>
                        <td class="encabezado-body" style="text-align: center;">{{$configuracion->moneda->simbolo.($pventa->obtener_costo_venta)}}</td>
                        <td class="encabezado-body">{{ $configuracion->moneda->simbolo.$pventa->monto_pago }}</td>
                        @php
                        $total2 = $total2 + $pventa->obtener_costo_venta;
                        @endphp
                    </tr>
                    @empty
                    @endforelse
                        <tr>
                            <td colspan="5" style="background-color: black;color:white;text-align:center;">
                                Total
                            </td>
                            <td class="text-center table-success" style="text-align: center;">{{$configuracion->moneda->simbolo.$posventas->sum('impuesto_monto')}}</td>
                            <td class="text-center table-success" style="text-align: center;">{{$configuracion->moneda->simbolo.$posventas->sum('descuento')}}</td>
                            <td class="text-center table-success" style="text-align: center;">{{$configuracion->moneda->simbolo.$posventas->sum('envio')}}</td>
                            <td class="text-center table-success" style="text-align: center;">{{$configuracion->moneda->simbolo.$total2}}</td>
                            <td class="text-center table-success" style="text-align: center;">{{$configuracion->moneda->simbolo.$posventas->sum('monto_pago')}}</td>
                        </tr>
                </tbody>
            </table>
        </div>
        <!--Devoluciones-->
        <div>
            <table class="table table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th  class="encabezado-dark" style="width:100px;" colspan="6">Devoluciones</th>
                    </tr>
                    <tr class="text-center">
                        <th class="encabezado-dark" style="width:100px;">Fecha Venta</th>
                        <th class="encabezado-dark" style="width:100px;">Fecha Devolución</th>
                        <th class="encabezado-dark" style="width:100px;">Recibo de Venta</th>
                        <th class="encabezado-dark" style="width:100px;">Almacen</th>
                        <th class="encabezado-dark" style="width:100px;">Cliente</th>
                        <th class="encabezado-dark" style="width:100px;">Total a Pagar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posventas as $pventa)
                        @foreach ($pventa->devolucions as $dev)
                            <tr>
                                <td class="encabezado-body">{{ $pventa->created_at }}</td>
                                <td class="encabezado-body">{{ $dev->fecha }}</td>
                                <td class="encabezado-body">{{ "SL_".$pventa->id }}</td>
                                <td class="encabezado-body">{{ $dev->almacen_name }}</td>
                                <td class="encabezado-body">{{ $dev->cliente_name }}</td>
                                <td class="encabezado-body">{{ $dev->monto_pago }}</td>
                            </tr>
                        @endforeach
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
        <!--compras-->
        <!--- <div>
            <table class="table table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th  class="encabezado-dark" style="width:100px;" colspan="5">Compras</th>
                    </tr>
                    <tr class="text-center">
                        <th class="encabezado-dark" style="width:100px;">Fecha Pago</th>
                        <th class="encabezado-dark" style="width:100px;">Forma Pago</th>
                        <th class="encabezado-dark" style="width:100px;">Monto Pago</th>
                        <th class="encabezado-dark" style="width:100px;">Compra</th>
                        <th class="encabezado-dark" style="width:100px;">Almacen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                            <tr>
                                <td class="encabezado-body">{{$compra->fecha_pago }}</td>
                                <td class="encabezado-body">{{$compra->opcion_pago}}</td>
                                <td class="encabezado-body">{{$compra->monto_pago }}</td>
                                <td class="encabezado-body">{{ "COM_".$compra->compra->id }}</td>
                                <td class="encabezado-body">{{$compra->compra->almacen->id }}</td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div> -->
        <!--gastos-->
        <!---    <div>
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th  class="encabezado-dark" style="width:100px;" colspan="5">Gastos</th>
                            </tr>
                            <tr class="text-center">
                                <th class="encabezado-dark" style="width:100px;">Fecha Pago</th>
                                <th class="encabezado-dark" style="width:100px;">Forma Pago</th>
                                <th class="encabezado-dark" style="width:100px;">Monto Pago</th>
                                <th class="encabezado-dark" style="width:100px;">Compra</th>
                                <th class="encabezado-dark" style="width:100px;">Almacen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compras as $compra)
                                    <tr>
                                        <td class="encabezado-body">{{$compra->fecha_pago }}</td>
                                        <td class="encabezado-body">{{$compra->opcion_pago}}</td>
                                        <td class="encabezado-body">{{$compra->monto_pago }}</td>
                                        <td class="encabezado-body">{{ "COM_".$compra->compra->id }}</td>
                                        <td class="encabezado-body">{{$compra->compra->almacen->id }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> -->
    @endif
    <div>
        <table>
            <tr>
                <td colspan="2" style="background-color: black;color:white;width:150px;text-align:center;">Resumen de Ventas y devoluciones</td>
            </tr>
            <tr>
                <td style="background-color: black;color:white;width:150px;text-align:center;">Ventas</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$posventas->sum('monto_pago')}}</td>
            </tr>
            @if ($simple == true)
            <tr>
                <td style="background-color: black;color:white;width:150px;text-align:center;">Gastos</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$gastos->sum('monto')}}</td>
            </tr>
            @endif
            <tr>
                <td style="background-color: black;color:white;width:150px;text-align:center;">Devoluciones</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$total_devoluciones}}</td>
            </tr>
            @php
                if ($simple == true) {
                    $total_a = $posventas->sum('monto_pago')-$gastos->sum('monto')-$total_devoluciones;
                }
                else 
                {
                    $total_a = $posventas->sum('monto_pago')-$total_devoluciones;
                }

            @endphp
            <tr>
                <td style="background-color: black;color:white;width:150px;text-align:center;">Total</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$total_a}}</td>
            </tr>
        </table>
    </div>
    <div>
        <table>
            <tr>
                <td colspan="2" style="background-color: black;color:white;width:150px;text-align:center;">Resumen de Ganancia Bruta</td>
            </tr>
            <tr>
                <td style="background-color: black;color:white;width:150px;text-align:center;">Ventas</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.round($posventas->sum('monto_pago'),3)}}</td>
            </tr>
            <tr>
                <td style="background-color: black;color:white;width:150px;text-align:center;">Costo Venta</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.round($total2,3)}}</td>
            </tr>
            <tr>
                <td style="background-color: black;color:white;width:150px;text-align:center;">Utilidad</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.round(($posventas->sum('monto_pago')-$total2),3)}}</td>
            </tr>
        </table>
    </div>

</body>
</html>
