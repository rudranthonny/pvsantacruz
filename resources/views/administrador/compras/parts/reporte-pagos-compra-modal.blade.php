<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalreportepagoscompra">
    Modal Pagos Compras
</button>

<!-- Modal -->
<div class="modal fade" id="modalreportepagoscompra" tabindex="-1" aria-labelledby="modalReportePagosCompraLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalReportePagosCompraLabel">Lista de Pagos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_reporte_pagos_compra_x"></button>
            </div>
            <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr class="table-dark">
                                        <th class="text-center">Fecha Pago</th>
                                        <th class="text-center">Opción Pago</th>
                                        <th class="text-center">Cantidad Recibida</th>
                                        <th class="text-center">Monto Pago</th>
                                        <th class="text-center">Cambio</th>
                                        <th class="text-center">Nota</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                @if (isset($pagocompraform->compra))
                                <tbody class="table-secondary">
                                    @foreach ($pagocompraform->compra->pagocompras as $pcompra)
                                    <tr>
                                        <td class="text-center">{{$pcompra->fecha_pago}}</td>
                                        <td class="text-center">{{$pcompra->opcion_pago}}</td>
                                        <td class="text-center">{{$configuracion->moneda->simbolo.$pcompra->cantidad_recibida}}</td>
                                        <td class="text-center">{{$configuracion->moneda->simbolo.$pcompra->monto_pago}}</td>
                                        <td class="text-center">{{$configuracion->moneda->simbolo.$pcompra->cambio}}</td>
                                        <td class="text-center">{{$pcompra->nota}}</td>
                                        <th class="text-center"><button type="button" class="btn btn-danger"
                                            wire:click="eliminar_pago_compra({{ $pcompra->id }})"
                                            id="eliminar-pcompra-{{ $pcompra->id }}"
                                            wire:confirm="Estas seguro de Eliminar esta Pago">
                                            <i class="fas fa-trash"></i>
                                        </button></th>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    @script
    <script>
        $wire.on('cerrar_modal_reporte_pagos_compra', reservacion => {
            ventana = document.getElementById('cerrar_modal_reporte_pagos_compra_x').click();
        });
    </script>
    @endscript
</div>
