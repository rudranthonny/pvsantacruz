<table>
    <thead>
        <tr>
            <th style="background-color: black;color:white;width:240px;">CODIGO_PRODUCTO</th>
            <th style="background-color: black;color:white;width:240px;">ALMACEN</th>
            <th style="background-color: black;color:white;width:180px;">DESCRIPCION</th>
            <th style="background-color: black;color:white;width:120px;">UNIDAD_DE_MEDIDA</th>
            <th style="background-color: black;color:white;width:120px;">CANTIDAD</th>
            <th style="background-color: black;color:white;width:150px;">COSTO_UNITARIO</th>
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
            <tr>
                <td>{{$proalm->producto->codigo}}</td>
                <td>{{$proalm->almacen->nombre}}</td>
                <td>{{$proalm->producto->designacion}}</td>
                <td>{{$proalm->producto->cunidad->name}}</td>
                <td>{{$proalm->stock}}</td>
                <td>{{$proalm->producto->costo}}</td>
                <td>{{$proalm->stock*$proalm->producto->costo}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
