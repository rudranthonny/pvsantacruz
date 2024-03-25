<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#agregarPagoPosModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="agregarPagoPosModal" tabindex="-1" aria-labelledby="agregarPagoPosModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="agregarPagoPosModalLabel">Agregar Pago</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="cantidad_recibida" class="form-label">Cantidad
                                        Recibida</label>
                                    <input type="number" class="form-control form-control-sm"
                                        id="cantidad_recibida" wire:model.live="cantidad_recibida" min="{{ $min_cantidad_recibida }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="monto_pago" class="form-label">Monto de pago</label>
                                    <input type="number" class="form-control form-control-sm"
                                        id="monto_pago" value="{{ $monto_pago }}" disabled>
                                </div>
                            </div>
                            <div>
                                <p class="m-0">Cambiar:</p>
                                <p class="text-danger">{{ number_format($cambio, 2) }}</p>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="cash" class="form-label">Opción de pago
                                        *</label>
                                    <select id="cash" class="form-control form-control-sm">
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="nota_pago" class="form-label">Nota de pago
                                        *</label>
                                    <textarea id="nota_pago" cols="30" rows="4" class="form-control form-control-sm" wire:model='nota_pago'></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col">
                                <div class="card body p-3 mb-3">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-auto">Productos totales
                                                        </div>
                                                        <div class="col-auto">{{ collect($items)->count() }}</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-auto">Impuesto de orden
                                                        </div>
                                                        <div class="col-auto">{{ 'S/ '.number_format($impuesto_monto, 2).' ('.$impuesto_porcentaje.' %)' }}</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-auto">Descuento
                                                        </div>
                                                        <div class="col-auto">{{ 'S/ '.number_format($descuento, 2) }}</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-auto">Envío
                                                        </div>
                                                        <div class="col-auto">{{ 'S/ '.number_format($envio, 2) }}</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-auto">Total por Pagar
                                                        </div>
                                                        <div class="col-auto">{{ 'S/ '.number_format($total_pagar, 2) }}</div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="nota_venta" class="form-label">Nota de venta
                                        *</label>
                                    <textarea id="nota_venta" cols="30" rows="4" class="form-control form-control-sm" wire:model='nota_venta'></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:click='guardar'>Guardar</button>
            </div>
        </div>
    </div>
</div>
