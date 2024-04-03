<table>
    <thead>
        <tr>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Fecha</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Referencia</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Proveedor</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Almacen</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Estado</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Total</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Pagado</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Debido</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Estado de Pago</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($lista_compras as $compra)
            <tr>
                <td style="border: solid 1px black;text-align: center;">{{ $compra->fecha }}</td>
                <td style="border: solid 1px black;text-align: center;">{{ "COM_".$compra->id }}</td>
                <td style="border: solid 1px black;text-align: center;">{{ $compra->proveedor->name }}</td>
                <td style="border: solid 1px black;text-align: center;">{{ $compra->almacen->nombre }}</td>
                <td style="border: solid 1px black;text-align: center;">
                    @if ($compra->estado == 1)
                    <span class="badge text-bg-success">Recibido</span>
                    @elseif ($compra->estado == 2)
                    <span class="badge text-bg-primary">Pendiente</span>
                    @elseif ($compra->estado == 3)
                    <span class="badge text-bg-warning">Ordenado</span>
                    @endif
                </td>
                <td style="border: solid 1px black;text-align: center;">{{ $configuracion->moneda->simbolo.$compra->total }}</td>
                <td style="border: solid 1px black;text-align: center;">{{ $configuracion->moneda->simbolo.$compra->pagado }}</td>
                <td style="border: solid 1px black;text-align: center;">{{ $configuracion->moneda->simbolo.$compra->debido }}</td>
                <td style="border: solid 1px black;text-align: center;">
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
            <td class="text-center table-success" style="text-align: center;">{{$configuracion->moneda->simbolo.$lista_compras->sum('total')}}</td>
        </tr>
    </tbody>
</table>
