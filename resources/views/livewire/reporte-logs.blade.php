<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <h5 class="card-title">Reporte de Modificaciones</h5>
            </div>
        </div>
       
        <div class="row g-2 mb-3">
            <div class="col-md-4">
                <label>Modelo</label>
                <select class="form-select" wire:model.live="modelo">
                    <option value="Elegir">Elegir</option>
                    @foreach($modelosDisponibles as $clave => $nombre)
                        <option value="{{ $clave }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
             <div class="col-md-3">
                <label>ID Modal</label>
                <input type="text" class="form-control" wire:model.live="modal_id">
            </div>
            <div class="col-md-3">
                <label>Desde</label>
                <input type="date" class="form-control" wire:model.live="desde">
            </div>
            <div class="col-md-3">
                <label>Hasta</label>
                <input type="date" class="form-control" wire:model.live="hasta">
            </div>
           <div class="col-md-3">
                <label>Lista de Usuarios</label>
                <select class="form-select" wire:model.live.defer="buscar_usuario">
                    <option value="">-- Seleccione Usuario --</option>
                    @foreach ($lista_usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->id."-".$usuario->lastname."-".$usuario->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button class="btn btn-primary" wire:loading.attr='disabled' wire:target='consultar' wire:click="consultar">Consultar</button>

        <hr>

        @if(count($logs) > 0)
            <div class="table-responsive">
                <table class="table table-sm table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Modelo</th>
                            <th>ID</th>
                            <th>Campo</th>
                            <th>Valor anterior</th>
                            <th>Valor nuevo</th>
                            <th>Usuario</th>
                            <th>IP</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $index => $log)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ class_basename($log->loggable_type) }}</td>
                                <td>{{ $log->loggable_id."-"}} @if (isset($log->loggable->producto->id)){{$log->loggable->producto->designacion}} @endif</td>
                                <td>{{ $log->campo_modificado }}</td>
                                <td>{{ $log->valor_anterior }}</td>
                                <td>{{ $log->valor_nuevo }}</td>
                                <td>{{ $log->user->name ?? 'N/A' }}</td>
                                <td>{{ $log->ip }}</td>
                                <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted mt-3">No hay resultados para los filtros seleccionados.</p>
        @endif
    </div>
</div>