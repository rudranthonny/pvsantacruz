<table>
    <thead>
        <tr>
            <th style="background-color: black;color:white;width:240px;">CODIGO_PRODUCTO</th>
            <th style="background-color: black;color:white;width:240px;">ALMACEN</th>
            <th style="background-color: black;color:white;width:180px;">DESCRIPCION</th>
            <th style="background-color: black;color:white;width:120px;">UNIDAD_DE_MEDIDA</th>
            <th style="background-color: black;color:white;width:120px;">CANTIDAD</th>
            <th style="background-color: black;color:white;width:150px;">PRECIO_VENTA</th>
            <th style="background-color: black;color:white;width:150px;">PRECIO_COSTO</th>
            <th style="background-color: black;color:white;width:150px;">COSTO_TOTAL</th>
            <th style="background-color: black;color:white;width:150px;">AGRUPACION_GENERAL</th>
            <th style="background-color: black;color:white;width:150px;">SUB_AGRUPACION_1</th>
            <th style="background-color: black;color:white;width:150px;">SUB_AGRUPACION_2</th>
            <th style="background-color: black;color:white;width:150px;">SUB_AGRUPACION_3</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($almacens as $almacen)
            @foreach ($almacen->productoalmacens as $proalm)
            @if (isset($proalm->producto))
            <tr>
                <td>
                    @if (isset($proalm->producto))
                    {{$proalm->producto->codigo}}
                    @endif
                </td>
                <td>{{$proalm->almacen->nombre}}</td>
                <td>
                    @if (isset($proalm->producto))
                    {{$proalm->producto->designacion}}
                    @endif
                </td>
                <td>
                    @if (isset($proalm->producto))
                    {{$proalm->producto->cunidad->name}}
                    @endif
                </td>
                <td>{{$proalm->stock}}</td>
                <td>
                    @if (isset($proalm->producto))
                    {{$proalm->producto->precio}}
                    @endif
                </td>
                <td>
                    @if (isset($proalm->producto))
                    {{$proalm->producto->costo}}
                    @endif
                </td>

                <td>
                    @if (isset($proalm->producto))
                    {{$proalm->stock*$proalm->producto->costo}}
                    @endif
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endif
            @endforeach
        @endforeach
    </tbody>
</table>
