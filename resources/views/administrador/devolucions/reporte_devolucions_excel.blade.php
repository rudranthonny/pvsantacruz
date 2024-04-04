<table class="table table-hover">
    <thead class="table-light">
        <tr class="text-center">
            <th style="background-color: black;color:white;width:150px;text-align:center;">Fecha</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Almacen</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Cliente</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Impuesto Porcentaje</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Impuesto</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Descuento</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Envio</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Total a Pagar</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($lista_devolucions as $devolucion)
        <tr>
            <td style="border: solid 1px black;text-align: center;">{{ $devolucion->created_at }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $devolucion->almacen_name }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $devolucion->cliente_name }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $devolucion->impuesto_porcentaje }}%</td>
            <td style="border: solid 1px black;text-align: center;">{{ $configuracion->moneda->simbolo.$devolucion->impuesto_monto }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $configuracion->moneda->simbolo.$devolucion->descuento }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $configuracion->moneda->simbolo.$devolucion->envio }}</td>
            <td style="border: solid 1px black;text-align: center;">{{ $configuracion->moneda->simbolo.$devolucion->total_pagar }}</td>
        </tr>
        @empty
        @endforelse
            <tr>
                <td colspan="4" style="background-color: black;color:white;text-align:center;">
                    Total
                </td>
                <td class="text-center table-success" style="text-align: center;">{{$configuracion->moneda->simbolo.$lista_devolucions->sum('impuesto_monto')}}</td>
                <td class="text-center table-success" style="text-align: center;">{{$configuracion->moneda->simbolo.$lista_devolucions->sum('descuento')}}</td>
                <td class="text-center table-success" style="text-align: center;">{{$configuracion->moneda->simbolo.$lista_devolucions->sum('envio')}}</td>
                <td class="text-center table-success" style="text-align: center;">{{$configuracion->moneda->simbolo.$lista_devolucions->sum('total_pagar')}}</td>
            </tr>
    </tbody>
</table>
