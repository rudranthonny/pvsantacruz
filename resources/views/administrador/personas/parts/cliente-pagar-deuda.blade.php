<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalPagoDeuda">
    Modal Pagar Deuda
</button>

<!-- Modal -->
<div class="modal fade" id="modalPagoDeuda" tabindex="-1" aria-labelledby="modalPagoDeudaLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalPagoDeudaLabel">Pagar Deuda del Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_cliente_pagar_deuda_x"></button>
            </div>
            <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="pago_deuda_monto" class="form-label">Monto de Pago</label>
                            <input type="number" step="0.01" class="form-control" id="pago_deuda_monto" wire:model.live.debounce.500ms="pd_monto">
                            <span class="badge text-bg-danger">
                                @isset($clientesForm->cliente->deuda_total)
                                {{$configuracion->moneda->simbolo."".$clientesForm->cliente->deuda_total}}
                                @endisset
                            </span>
                            @error('pd_monto')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="pago_deuda_opcion" class="form-label">Opción de Pago</label>
                            <select name="" id="pago_deuda_opcion" class="form-select" wire:model="pd_opcion">
                                <option value="">Elegir</option>
                                <option value="Contado">Contado</option>
                                <option value="Deposito">Deposito</option>
                            </select>
                            @error('pd_opcion')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="pago_deuda_detalle" class="form-label">Porporcionar Detalle</label>
                            <textarea id="pago_deuda_detalle" class="form-control" cols="30" rows="5" wire:model='pago_deuda_detalle' wire:model="pd_detalle"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" wire:loading.attr="disabled" wire:target="generar_pago_deuda"  wire:click="generar_pago_deuda" class="btn btn-primary">Registrar Pagos</button>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('cerrar_modal_cliente_pagar_deuda', reservacion => {
            ventana = document.getElementById('cerrar_modal_cliente_pagar_deuda_x').click();
        });
    </script>
@endscript
