<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalReporteCajaLabel">
    Reporte Caja
</button>

<!-- Modal -->
<div class="modal fade " data-bs-focus="false" id="modalReporteCaja" tabindex="-1" aria-labelledby="modalReporteCajaLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalReporteCajaLabel">Reporte de Caja</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="cerrar_modal_caja_x"></button>
            </div>
            <div class="modal-body">
                @if ($cajero->cajas->where('fecha_cierre', false)->count() > 0)
                    <div class="row mb-3">
                        <div class="col-12 my-1">
                            <b>Nombre Cajero :</b> {{ $cajero->name . ' ' . $cajero->lastname }}<br>
                            <b> Caja Aperturada : </b>
                            {{ $cajero->cajas->where('fecha_cierre', false)->first()->fecha_apertura }} <br>
                            @if ($cajero->cajas->where('fecha_cierre', false)->first()->mcajas->first())
                                <b>Monto Inicial :</b>
                                {{ $configuracion->moneda->simbolo }}.{{ $cajero->cajas->where('fecha_cierre', false)->first()->mcajas->first()->monto }}
                                <br>
                                <b>Monto Actual :</b>
                                {{ $configuracion->moneda->simbolo }}.{{ $cajero->cajas->where('fecha_cierre', false)->first()->monto }}
                                <br>
                            @else
                                <b>Monto Inicial :</b> {{ $configuracion->moneda->simbolo }}.0
                            @endif
                        </div>
                        <div class="col-12">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">Tipo de movimiento</th>
                                        <th class="text-center">Signo</th>
                                        <th class="text-center">Ingreso</th>
                                        <th class="text-center">Egreso</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cajero->cajas->where('fecha_cierre', false)->first()->mcajas as $mcaja)
                                        <tr>
                                            <td class="text-center">{{ $mcaja->tmovmientocaja->name }}</td>
                                            <td class="text-center">{{ $mcaja->signo }}</td>
                                            <td class="text-center">
                                                @if ($mcaja->signo == '+')
                                                    {{ $configuracion->moneda->simbolo . $mcaja->monto }}
                                                @else
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($mcaja->signo == '-')
                                                    {{ $configuracion->moneda->simbolo . $mcaja->monto }}
                                                @else
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($mcaja->tmovimiento_caja_id == 3)
                                                    <input wire:click="eliminar_venta"
                                                        wire:loading.attr="disabled" class="btn btn-info" type="button"
                                                        id="Eliminar_venta-{{$mcaja->id}}" value="Eliminar venta">
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="table-dark text-center">Total</td>
                                        <td class="table-success text-center">
                                            {{ $configuracion->moneda->simbolo . $cajero->cajas->where('fecha_cierre', false)->first()->mcajas->where('signo', '+')->sum('monto') }}
                                        </td>
                                        <td class="table-danger text-center">
                                            {{ $configuracion->moneda->simbolo . $cajero->cajas->where('fecha_cierre', false)->first()->mcajas->where('signo', '-')->sum('monto') }}
                                        </td>
                                        <td class="table-info text-center">
                                            {{ $configuracion->moneda->simbolo . ($cajero->cajas->where('fecha_cierre', false)->first()->mcajas->where('signo', '+')->sum('monto') - $cajero->cajas->where('fecha_cierre', false)->first()->mcajas->where('signo', '-')->sum('monto')) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" wire:loading.attr="disabled"
                    wire:target="descargar_reporte_caja" wire:click='descargar_reporte_caja'>Descargar Reporte</button>
            </div>
        </div>
    </div>
</div>
