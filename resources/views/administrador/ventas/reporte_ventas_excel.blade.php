<table>
    <thead>
        <tr>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Fecha</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Almacen</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Comprobante</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Cliente</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Impuesto Porcentaje</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Impuesto</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Descuento</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Envio</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Costo Venta</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Total a Pagar</th>
        </tr>
    </thead>
    <tbody>
        @php $total2 = 0;@endphp
        @forelse ($lista_ventas as $pventa)
        <tr>
            <td style="border: solid 1px black;text-align: center;">{{ $pventa->created_at }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $pventa->almacen_name }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ "SL_".$pventa->id }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $pventa->cliente_name }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $pventa->impuesto_porcentaje }}%</td>
            <td style="border: solid 1px black;text-align: center;">{{ $configuracion->moneda->simbolo.$pventa->impuesto_monto }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $configuracion->moneda->simbolo.$pventa->descuento }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $configuracion->moneda->simbolo.$pventa->envio }}</td>
            <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.($pventa->obtener_costo_venta)}}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $configuracion->moneda->simbolo.$pventa->total_pagar }}</td>
        </tr>
        @empty
        @endforelse
            <tr>
                <td colspan="5" style="background-color: black;color:white;text-align:center;">
                    Total
                </td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$lista_ventas->sum('impuesto_monto')}}</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$lista_ventas->sum('descuento')}}</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$lista_ventas->sum('envio')}}</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$total2}}</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$lista_ventas->sum('total_pagar')}}</td>
            </tr>
    </tbody>
</table>

<table>
    <thead >
        <tr>
            <th style="background-color: black;color:white;width:150px;text-align:center;" colspan="6">Devoluciones</th>
        </tr>
        <tr>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Fecha Venta</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Fecha Devolución</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Recibo de Venta</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Almacen</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Cliente</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Total a Pagar</th>
        </tr>
    </thead>
    <tbody>
        @php $total_devoluciones = 0; @endphp
        @forelse ($lista_ventas as $pventa)
            @foreach ($pventa->devolucions as $dev)
            @php $total_devoluciones = $total_devoluciones+$dev->monto_pago; @endphp
                <tr>
                    <td style="border: solid 1px black;text-align: center;">{{ $pventa->created_at }}</td>
                    <td style="border: solid 1px black;text-align: center;">{{ $dev->fecha }}</td>
                    <td style="border: solid 1px black;text-align: center;">{{ "SL_".$pventa->id }}</td>
                    <td style="border: solid 1px black;text-align: center;">{{ $dev->almacen_name }}</td>
                    <td style="border: solid 1px black;text-align: center;">{{ $dev->cliente_name }}</td>
                    <td style="border: solid 1px black;text-align: center;">{{ $dev->monto_pago }}</td>
                </tr>
            @endforeach
        @empty
        @endforelse
    </tbody>
</table>

<table>
    <tr>
        <td colspan="2" style="background-color: black;color:white;width:150px;text-align:center;">Resumen de Ventas y devoluciones</td>
    </tr>
    <tr>
        <td style="background-color: black;color:white;width:150px;text-align:center;">Ventas</td>
        <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$lista_ventas->sum('total_pagar')}}</td>
    </tr>
    <tr>
        <td style="background-color: black;color:white;width:150px;text-align:center;">Devoluciones</td>
        <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$total_devoluciones}}</td>
    </tr>
    <tr>
        <td style="background-color: black;color:white;width:150px;text-align:center;">Total</td>
        <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.($lista_ventas->sum('total_pagar')-$total_devoluciones)}}</td>
    </tr>
</table>
<table>
    <tr>
        <td colspan="2" style="background-color: black;color:white;width:150px;text-align:center;">Resumen de Ganancia Bruta</td>
    </tr>
    <tr>
        <td style="background-color: black;color:white;width:150px;text-align:center;">Ventas</td>
        <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$lista_ventas->sum('total_pagar')}}</td>
    </tr>
    <tr>
        <td style="background-color: black;color:white;width:150px;text-align:center;">Costo Venta</td>
        <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.$total2}}</td>
    </tr>
    <tr>
        <td style="background-color: black;color:white;width:150px;text-align:center;">Utilidad</td>
        <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo.($lista_ventas->sum('total_pagar')-$total2)}}</td>
    </tr>
</table>
