<table>
    <thead>
        <tr>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Tipo</th>
            <th style="background-color: black;color:white;width:240px;text-align:center;">Designacion</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Codigo</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Marca</th>
            <th style="background-color: black;color:white;width:150px;text-align:center;">Categoria</th>
            <th style="background-color: black;color:white;width:100px;text-align:center;">Precio</th>
            <th style="background-color: black;color:white;width:100px;text-align:center;">Unidad</th>
            <th style="background-color: black;color:white;width:100px;text-align:center;">Cantidad</th>
        </tr>
    </thead>
    @if ($lista_productos->count())
    <tbody>
        @forelse ($lista_productos as $produc)
            <tr>
                <td style="border: solid 1px black;text-align: center;">{{ $produc->tipo }}</td>
                <td style="border: solid 1px black;text-align: center;">{{ $produc->designacion }}</td>
                <td style="border: solid 1px black;text-align: center;">{{ $produc->codigo }}</td>
                <td style="border: solid 1px black;text-align: center;">{{ optional($produc->marca)->name }}</td>
                <td style="border: solid 1px black;text-align: center;">{{ optional($produc->categoria)->name }}</td>
                <td style="border: solid 1px black;text-align: center;">{{$configuracion->moneda->simbolo}}{{ $produc->precio }}</td>
                <td style="border: solid 1px black;text-align: center;">{{ optional($produc->cunitario)->name }}</td>
                <td style="border: solid 1px black;text-align: center;">{{ $produc->obtener_cantidad }}</td>
            </tr>
        @empty
        @endforelse
    </tbody>
    @else
    <tfoot class="table-light">
        <tr>
            <td colspan="10" class="text-center" >No Hay Productos Registrados</td>
        </tr>
    </tfoot>
    @endif
</table>
