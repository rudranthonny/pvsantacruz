<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Reservas</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h3, h4 { margin: 0; padding: 0; text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #000; padding: 6px; text-align: center; }
        .table th { background-color: #f0f0f0; }
    </style>
</head>
<body>

    <h3>REPORTE DE RESERVAS POR CANCHAS</h3>
    <h4>Del {{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}</h4>

    <br>
    <h4>1. Ingresos Totales</h4>
    <p><strong>S/ {{ number_format($ingresos, 2) }}</strong></p>

    <br>
    <h4>2. Reservas por Cancha</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Cancha</th>
                <th>Total</th>
                <th>Utilizadas</th>
                <th>Reservadas</th>
                <th>Solicitudes Anulación</th>
                <th>Anuladas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservas_por_cancha as $res)
            <tr>
                <td>{{ $res['cancha'] }}</td>
                <td>{{ $res['total'] }}</td>
                <td>{{ $res['utilizadas'] }}</td>
                <td>{{ $res['reservadas'] }}</td>
                <td>{{ $res['solicitudes'] }}</td>
                <td>{{ $res['anuladas'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <h4>3. Partidas Gratuitas por Cliente</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Horas Gratuitas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gratuitas_por_cliente as $cli)
            <tr>
                <td>{{ $cli['cliente'] }}</td>
                <td>{{ $cli['gratuitas'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <h4>4. Detalle de Reservas</h4>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Hora Ingreso</th>
                <th>Hora Salida</th>
                <th>Cliente</th>
                <th>Cancha</th>
                <th>Horas</th>
                <th>Subtotal</th>
                <th>Estado</th>
                <th>Gratuito</th>
                <th>Anulación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservas as $index => $r)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($r->fingreso)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($r->fingreso)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($r->fsalida)->format('H:i') }}</td>
                <td>{{ $r->cliente->name ?? '—' }}</td>
                <td>{{ $r->cancha->name ?? '—' }}</td>
                <td>{{ $r->horas }}</td>
                <td>S/ {{ number_format($r->subtotal, 2) }}</td>
                <td>{{ $r->estado }}</td>
                <td>{{ $r->gratuito ? 'Sí' : 'No' }}</td>
                <td>
                    @if($r->motivo_anulacion)
                        {{ Str::limit($r->motivo_anulacion, 40) }}
                    @else
                        —
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
