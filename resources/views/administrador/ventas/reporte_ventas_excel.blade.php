<table class="table table-hover">
    <thead class="table-light">
        <tr class="text-center">
            <th>Fecha</th>
            <th>Almacen</th>
            <th>Cliente</th>
            <th>Impuesto Porcentaje</th>
            <th>Impuesto</th>
            <th>Descuento</th>
            <th>Envio</th>
            <th>Total a Pagar</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($posventas as $pventa)
        <tr>
            <td role="cell" class="text-center"  style="vertical-align: middle;">{{ $pventa->created_at }}</td>
            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $pventa->almacen_name }}</td>
            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $pventa->cliente_name }}</td>
            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $pventa->impuesto_porcentaje }}%</td>
            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $configuracion->moneda->simbolo.$pventa->impuesto_monto }}</td>
            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $configuracion->moneda->simbolo.$pventa->descuento }}</td>
            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $configuracion->moneda->simbolo.$pventa->envio }}</td>
            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $configuracion->moneda->simbolo.$pventa->total_pagar }}</td>
            <td role="cell" class="text-center" style="vertical-align: middle;"><button class="btn btn-danger" wire:loading.attr='disabled' id="venta_descargar-{{$pventa->id}}" wire:target='descargar_venta_pdf({{$pventa->id}})' wire:click='descargar_venta_pdf({{$pventa->id}})'><i class="fas fa-download"></i></button></td>
        </tr>
        @empty
        @endforelse
            <tr>
                <td colspan="4" class="table-dark text-center">
                    Total
                </td>
                <td class="text-center table-success">{{$configuracion->moneda->simbolo.$posventas->sum('impuesto_monto')}}</td>
                <td class="text-center table-success">{{$configuracion->moneda->simbolo.$posventas->sum('descuento')}}</td>
                <td class="text-center table-success">{{$configuracion->moneda->simbolo.$posventas->sum('envio')}}</td>
                <td class="text-center table-success">{{$configuracion->moneda->simbolo.$posventas->sum('total_pagar')}}</td>
                <td class="text-center table-dark"></td>
            </tr>
    </tbody>
</table>
