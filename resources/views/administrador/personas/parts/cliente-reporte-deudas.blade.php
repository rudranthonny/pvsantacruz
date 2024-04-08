<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalReporteDeudas">
    Modal Pagar Deuda
</button>

<!-- Modal -->
<div class="modal fade" id="modalReporteDeudas" tabindex="-1" aria-labelledby="modalReporteDeudasLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalReporteDeudasLabel">Reporte de Deuda del Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_cliente_reporte_deudas_x"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Monto</th>
                                <th class="text-center">Opción</th>
                                <th class="text-center">Detalle</th>
                                <th class="text-center">Fecha</th>
                            </tr>
                        </thead>
                        @if (isset($clientesForm->cliente->pagodeudas))
                        <tbody>
                            @forelse ($clientesForm->cliente->pagodeudas as $pdeuda)
                            <tr role="row" class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#tablecollapse-{{$pdeuda->id}}" aria-expanded="false" aria-controls="tablecollapse-{{$pdeuda->id}}">
                                <td role="cell" class="text-center"  style="vertical-align: middle;">{{ $pdeuda->monto }}</td>
                                <td role="cell" class="text-center" style="vertical-align: middle;">{{ $pdeuda->opcion }}</td>
                                <td role="cell" class="text-center" style="vertical-align: middle;">{{ $pdeuda->detalle }}</td>
                                <td role="cell" class="text-center" style="vertical-align: middle;">{{ $pdeuda->fecha }}</td>
                            </tr>
                            <tr role="row">
                                <td role="cell" colspan="9" class="p-0">
                                    <div id="tablecollapse-{{$pdeuda->id}}" class="accordion-collapse collapse" aria-labelledby="heading-1" data-bs-parent="#accordionExample" style="">
                                        <div>
                                            <table role="table" width="100%" class="table table-primary">
                                                <thead role="rowgroup">
                                                    <tr>
                                                        <th colspan="4"><center>DETALLE DEL MONTO A PAGAR</center></th>
                                                    </tr>
                                                    <tr role="row">
                                                        <th class="text-center" role="columnheader">Venta</th>
                                                        <th class="text-center" role="columnheader">Monto Pendiente</th>
                                                        <th class="text-center" role="columnheader">Monto Pagado</th>
                                                        <th class="text-center" role="columnheader">Monto Restante</th>
                                                        <th class="text-center" role="columnheader">Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody role="rowgroup">
                                                    @foreach ($pdeuda->pagorelacionados as $prelacionado)
                                                    <tr role="row">
                                                        <td role="cell" class="text-center"> {{'SL_'.$prelacionado->posventa_id}} </td>
                                                        <td role="cell" class="text-center"> {{$prelacionado->monto_pendiente}} </td>
                                                        <td role="cell" class="text-center"> {{$prelacionado->monto_pagado}} </td>
                                                        <td role="cell" class="text-center"> {{$prelacionado->monto_restante}} </td>
                                                        <td role="cell" class="text-center"> {{$prelacionado->estado}} </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('cerrar_modal_cliente_reporte_deudas', reservacion => {
            ventana = document.getElementById('cerrar_modal_cliente_reporte_deudas_x').click();
        });
    </script>
@endscript
