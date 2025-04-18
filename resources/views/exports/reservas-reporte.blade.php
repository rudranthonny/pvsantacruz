<table>
    <tr>
        <th colspan="6" style="font-size:18px;text-align:center">REPORTE DE RESERVAS POR CANCHAS</th>
    </tr>
    <tr>
        <th colspan="6" style="text-align:center">
            Del {{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}
        </th>
    </tr>

    <tr><td colspan="6"></td></tr>

    {{-- Ingresos Totales --}}
    <tr>
        <th colspan="3">Ingresos Totales</th>
        <td colspan="3">S/ {{ number_format($ingresos, 2) }}</td>
    </tr>

    <tr><td colspan="6"></td></tr>

    {{-- Reservas por Cancha --}}
    <tr><th colspan="6">RESUMEN POR CANCHA</th></tr>
    <tr>
        <th>Cancha</th>
        <th>Total</th>
        <th>Utilizadas</th>
        <th>Reservadas</th>
        <th>Solicitudes Anulación</th>
        <th>Anuladas</th>
    </tr>
    @foreach ($reservas_por_cancha as $rc)
        <tr>
            <td>{{ $rc['cancha'] }}</td>
            <td>{{ $rc['total'] }}</td>
            <td>{{ $rc['utilizadas'] }}</td>
            <td>{{ $rc['reservadas'] }}</td>
            <td>{{ $rc['solicitudes'] }}</td>
            <td>{{ $rc['anuladas'] }}</td>
        </tr>
    @endforeach

    <tr><td colspan="6"></td></tr>

    {{-- Gratuitas por Cliente --}}
    <tr><th colspan="6">PARTIDAS GRATUITAS POR CLIENTE</th></tr>
    <tr>
        <th>Cliente</th>
        <th colspan="5">Horas Gratuitas</th>
    </tr>
    @foreach ($gratuitas_por_cliente as $g)
        <tr>
            <td>{{ $g['cliente'] }}</td>
            <td colspan="5">{{ $g['gratuitas'] }}</td>
        </tr>
    @endforeach

    <tr><td colspan="6"></td></tr>

    {{-- Detalle de Reservas --}}
    <tr><th colspan="11">DETALLE DE RESERVAS</th></tr>
    <tr>
        <th>#</th>
        <th>Fecha</th>
        <th>Ingreso</th>
        <th>Salida</th>
        <th>Cliente</th>
        <th>Cancha</th>
        <th>Horas</th>
        <th>Subtotal</th>
        <th>Estado</th>
        <th>Gratuito</th>
        <th>Anulación</th>
    </tr>
    @foreach ($reservas as $index => $r)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($r->fingreso)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($r->fingreso)->format('H:i') }}</td>
            <td>{{ \Carbon\Carbon::parse($r->fsalida)->format('H:i') }}</td>
            <td>{{ $r->cliente->name ?? '—' }}</td>
            <td>{{ $r->cancha->name ?? '—' }}</td>
            <td>{{ $r->horas }}</td>
            <td>{{ number_format($r->subtotal, 2) }}</td>
            <td>{{ $r->estado }}</td>
            <td>{{ $r->gratuito ? 'Sí' : 'No' }}</td>
            <td>{{ $r->motivo_anulacion ? \Illuminate\Support\Str::limit($r->motivo_anulacion, 40) : '—' }}</td>
        </tr>
    @endforeach
</table>
