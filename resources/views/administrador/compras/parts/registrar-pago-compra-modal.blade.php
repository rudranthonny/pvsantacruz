<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalpagocompra">
    Modal Pagos Compras
</button>

<!-- Modal -->
<div class="modal fade" id="modalpagocompra" tabindex="-1" aria-labelledby="modalPagoCompraLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalPagoCompraLabel">{{ $titlemodal_pagocompra }} Pago</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_pago_compra_x"></button>
            </div>
            <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="nombre" class="form-label">Fecha Pago <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="codigom"
                                 wire:model.live="pagocompraform.fecha_pago">
                            @error('pagocompraform.fecha_pago')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="telefono" class="form-label">Referencia</label>
                            <input type="text" class="form-control" disabled id="nombrem" wire:model="referencia_compra_id">
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="compra_almacen" class="form-label">Opción de Pago <span class="text-danger">*</span></label>
                            <select class="form-select" id="compra_almacen" wire:model.live="pagocompraform.opcion_pago">
                                <option value="">Elegir</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="deposito">Deposito</option>
                            </select>
                            @error('pagocompraform.opcion_pago')
                            <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                         <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="pagocompraform_cantidad_recibida" class="form-label">Cantidad Recibida<span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="pagocompraform_cantidad_recibida"
                                 wire:model.live.debounce.500ms="pagocompraform.cantidad_recibida">
                            @error('pagocompraform.cantidad_recibida')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="pagocompraform_cantidad_recibida" class="form-label">Monto de Pago<span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="pagocompraform_monto_pago"
                                 wire:model.live.debounce.500ms="pagocompraform.monto_pago">
                            @error('pagocompraform.monto_pago')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="pagocompraform_cantidad_recibida" class="form-label">Cambiar<span class="text-danger">*</span></label><br>
                            {{$pagocompraform->cambio}}
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" wire:click='guardar_pago' class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
    @script
    <script>
        $wire.on('cerrar_modal_pago_compra', reservacion => {
            ventana = document.getElementById('cerrar_modal_pago_compra_x').click();
        });
    </script>
    @endscript
</div>


