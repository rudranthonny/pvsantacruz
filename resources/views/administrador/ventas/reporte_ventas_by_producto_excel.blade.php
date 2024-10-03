<table>
    <tr>
        <td></td>
        <td colspan="4">
            <b>{{$configuracion->name}}</b>
        </td>
    </tr>
    <tr>
        <td></td>
        <td colspan="4">
            <b> Ventas del {{$finicio}} al {{$ffinal}}</b>
        </td>
    </tr>
    <tr>
        <td></td>
        <td colspan="4">
            <b>Fecha de Impresión {{date('d/m/Y H:i:s')}}</b>
        </td>
    </tr>
</table>

<table>
    <tr>
        <th style="width: 170px;border-top: solid 36px;border-bottom: solid 3px;"><b>Codigo</b></th>
        <th style="width: 250px;border-top: solid 36px;border-bottom: solid 3px;"><b>Descripción</b></th>
        <th style="width: 100px;border-top: solid 36px;border-bottom: solid 3px;"><b>Cantidad</b></th>
        <th style="width: 100px;text-align: right;border-top: solid 36px;border-bottom: solid 3px;"><b>Val. Aprox U</b></th>
        <th style="width: 100px;text-align: right;border-top: solid 36px;border-bottom: solid 3px;"><b>Valor</b></th>
    </tr>
    @php $total = 0 @endphp
    @foreach ($lista_ventas_productos as $key => $arre)
        @php $total = $total + $lista_ventas_productos[$key]['total']  @endphp
        <tr>
            <th>{{$lista_ventas_productos[$key]['codigo']}}s</th>
            <th>{{$lista_ventas_productos[$key]['descripcion']}}</th>
            <th>{{$lista_ventas_productos[$key]['cantidad']}}</th>
            <th>{{$lista_ventas_productos[$key]['precio']}}</th>
            <th>{{$lista_ventas_productos[$key]['total']}}</th>
        </tr>
    @endforeach
        <tr>
            <td style="border-top: solid 36px;"></td>
            <td style="border-top: solid 36px;"></td>
            <td style="border-top: solid 36px;"></td>
            <td style="border-top: solid 36px;"></td>
            <td style="border-top: solid 36px;">{{$total}}</td>
        </tr>
</table>
