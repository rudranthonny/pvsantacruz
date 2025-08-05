<div>
    <div class="row mb-3">
        <div class="col-12 col-md-4">
            <label class="form-label">Fecha Inicio</label>
            <input type="date" class="form-control" wire:model.live="fecha">
        </div>
         <div class="col-12 col-md-4">
            <label class="form-label">Fecha Final</label>
            <input type="date" class="form-control" wire:model.live="fecha_final">
        </div>
        <div class="col-12 col-md-4">
            <label class="form-label">Usuario</label>
            <select class="form-select" wire:model.live="usuario_id">
                <option value="">Todos</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name." ".$usuario->lastname }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @foreach ($cajas as $caja)
        <div class="card mb-3">
            <div class="card-header bg-dark text-white d-flex justify-content-between">
                <span>Caja abierta por: {{ $caja->user->name }}</span>
                <span>{{ $caja->fecha_apertura }}</span>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tipo Movimiento</th>
                            <th>Signo</th>
                            <th>Monto</th>
                            <th>Origen</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($caja->mcajas_deleted as $mov)
                            <tr @if($mov->trashed()) class="table-danger" @endif>
                                <td>{{ $mov->tipo->name ?? '-' }}</td>
                                <td>{{ $mov->signo }}</td>
                                <td>S/ {{ number_format($mov->monto, 2) }}</td>
                                <td>{{ $mov->created_at }}</td>
                                <td>
                                    @if($mov->trashed())
                                        <span class="badge bg-danger">Eliminado</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $cajas->links() }}
    </div>
</div>
