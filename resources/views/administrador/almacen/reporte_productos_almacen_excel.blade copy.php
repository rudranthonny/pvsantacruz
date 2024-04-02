<table>
    <thead>
        <tr>
            <th style="background-color: black;color:white;width:240px;">Producto</th>
            <th style="background-color: black;color:white;width:180px;">Almacen</th>
            <th style="background-color: black;color:white;width:120px;">Stock</th>
            <th style="background-color: black;color:white;width:120px;">Stock Limite</th>
            <th style="background-color: black;color:white;width:150px;">Estado</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($productos_almacen as $palmacen)
            <tr>
                <td>{{ $palmacen->producto->designacion }}</td>
                <td>{{ $palmacen->almacen->nombre }}</td>
                <td>{{ $palmacen->stock }}</td>
                <td>{{ $palmacen->producto->alerta_stock }}</td>
                <td>
                    @if ($palmacen->stock == 0)
                        <span class="badge text-bg-danger">Insuficiente</span>
                    @elseif (
                    $palmacen->stock > 0
                            &&
                    $palmacen->stock <=2
                    )
                        <span class="badge text-bg-warning">Por Acabar</span>
                    @elseif ($palmacen->stock >= 3 && $palmacen->stock <= $palmacen->producto->alerta_stock)
                        <span class="badge text-bg-success">Suficiente</span>
                    @elseif ($palmacen->stock > $palmacen->producto->alerta_stock )
                    <span class="badge text-bg-info">Exceso</span>
                    @endif
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
