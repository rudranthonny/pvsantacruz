<div wire:ignore.self class="modal fade" id="modal_solicitudes" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Lista de Anulaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="cerrar_modal_solicitud_x"></button>
            </div>
            <div class="modal-body">
                @if (isset($scancha->id))
                    <div class="row mt-3">
                        <div class="col-12">
                            <h5 class="text-center">Solicitudes de Reserva Pendientes con Anulación</h5>
                            @if ($scancha->reservas_solicitudes->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-dark text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Cliente</th>
                                                <th>Ingreso</th>
                                                <th>Salida</th>
                                                <th>Horas</th>
                                                <th>Costo</th>
                                                <th>Motivo de Anulación</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($scancha->reservas_solicitudes as $index => $reserva)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>{{ $reserva->cliente->name ?? '—' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($reserva->fingreso)->format('d/m/Y H:i') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($reserva->fsalida)->format('d/m/Y H:i') }}</td>
                                                    <td class="text-center">{{ $reserva->horas }}</td>
                                                    <td class="text-end">Q{{ number_format($reserva->costo, 2) }}</td>
                                                    <td>{{ $reserva->motivo_anulacion }}</td>
                                                    <td>
                                                        <button class="btn btn-success"
                                                                wire:confirm='¿Estás seguro de aceptar esta anulación?'
                                                                wire:loading.attr='disabled'
                                                                id="aceptar_anulacion-{{ $reserva->id }}"
                                                                wire:target='aceptar_anulacion'
                                                                wire:click='aceptar_anulacion({{ $reserva->id }})'>
                                                            Aceptar Anulación
                                                        </button>
                                                
                                                        <button class="btn btn-danger"
                                                                wire:confirm='¿Estás seguro de cancelar esta solicitud de anulación?'
                                                                wire:loading.attr='disabled'
                                                                id="cancelar_anulacion-{{ $reserva->id }}"
                                                                wire:target='cancelar_anulacion'
                                                                wire:click='cancelar_anulacion({{ $reserva->id }})'>
                                                            Cancelar Anulación
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info text-center">
                                    No hay solicitudes pendientes con motivo de anulación.
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    @script
    <script>
        $wire.on('cerrar_modal_solicitudes', () => {
            document.getElementById('cerrar_modal_solicitud_x').click();
        });
    </script>
    @endscript
</div>
