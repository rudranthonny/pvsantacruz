<div class="container mt-4">
    <h5 class="mb-3">Administrar Reservas</h5>

    <!-- Filtros -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="finicio" class="form-label">Fecha Inicio</label>
            <input type="date" class="form-control" id="finicio" wire:model.live.defer="finicio">
        </div>
        <div class="col-md-3">
            <label for="ffinal" class="form-label">Fecha Final</label>
            <input type="date" class="form-control" id="ffinal" wire:model.live.defer="ffinal">
        </div>
        <div class="col-md-3">
            <label for="searchCliente" class="form-label">Buscar cliente</label>
            <input type="text" class="form-control" id="searchCliente" placeholder="Nombre del cliente"
                wire:model.live.debounce.500ms="searchCliente">
        </div>
        <div class="col-md-2">
            <label class="form-label">Registros por página</label>
            <select class="form-select" wire:model.live="pagina">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="mb-3">
            @if(count($seleccionadas) > 0)
                <button wire:click="eliminarSeleccionadas" wire:confirm="¿Estás seguro de eliminar las reservas seleccionadas?" class="btn btn-danger btn-sm">
                    Eliminar seleccionadas ({{ count($seleccionadas) }})
                </button>
            @endif
        </div>
    </div>

    <!-- Tabla de resultados -->
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead class="table-dark">
                <tr>
                    <th><input type="checkbox" wire:model.live="selectAll"></th>
                    <th>Ingreso</th>
                    <th>Salida</th>
                    <th>Horas</th>
                    <th>Cancha</th>
                    <th>Cliente</th>
                    <th>Costo</th>
                    <th>Estado</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservas as $reserva)
                    <tr>
                        <td>
                            @if (is_null($reserva->posventa_detalle_id))
                                <input type="checkbox" id="select-{{$reserva->id}}" wire:model.live="seleccionadas" value="{{ $reserva->id }}">
                            @endif
                        </td>
                        <td>{{ $reserva->fingreso }}</td>
                        <td>{{ $reserva->fsalida }}</td>
                        <td>{{ $reserva->horas }}</td>
                        <td>{{ $reserva->cancha->name ?? '-' }}</td>
                        <td>{{ $reserva->cliente->name ?? '-' }}</td>
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
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No se encontraron reservas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-2">
        {{ $reservas->links() }}
    </div>
</div>
