<div class="container mt-4">
    <h5>Reservas del cliente: {{ $cliente->name }}</h5>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="mb-3">
        <button wire:click="eliminarSinDetalle" wire:confirm='¿Seguro de Eliminar estas Reservas?' class="btn btn-danger btn-sm">Eliminar todas las reservas sin detalle</button>
        @if(count($seleccionadas) > 0)
            <button wire:click="eliminarSeleccionadas" wire:confirm='¿Seguro de Eliminar estas Reservas?' class="btn btn-warning btn-sm">Eliminar seleccionadas</button>
        @endif
    </div>

    <table class="table table-bordered table-sm">
        <thead class="table-dark">
            <tr>
                <th><input type="checkbox" wire:model.live="selectAll"></th>
                <th>Ingreso</th>
                <th>Salida</th>
                <th>Horas</th>
                <th>Cancha</th>
                <th>Costo</th>
                <th>Estado</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
                <tr>
                    <td>
                        @if (is_null($reserva->posventa_detalle_id))
                            <input type="checkbox" wire:model.live="seleccionadas" value="{{ $reserva->id }}">
                        @endif
                    </td>
                    <td>{{ $reserva->fingreso }}</td>
                    <td>{{ $reserva->fsalida }}</td>
                    <td>{{ $reserva->horas }}</td>
                    <td>{{ $reserva->cancha->name ?? '-' }}</td>
                    <td>Q {{ number_format($reserva->costo, 2) }}</td>
                    <td><span class="badge bg-info">{{ $reserva->estado }}</span></td>
                    <td>
                        @if($reserva->posventa_detalle_id)
                            <span class="text-success">✓</span>
                        @else
                            <span class="text-danger">Sin Detalle</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $reservas->links() }}
</div>
