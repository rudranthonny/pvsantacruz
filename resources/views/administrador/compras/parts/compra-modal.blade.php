<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalCompra">
    Modal Compras
</button>

<!-- Modal -->
<div class="modal fade" id="modalCompra" tabindex="-1" aria-labelledby="modalCompraLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCompraLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_compra_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioCompra">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="fecha" class="form-label">Fecha <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fecha" placeholder="Ingrese Fecha"
                                required wire:model="comprasForm.fecha">
                            @error('comprasForm.fecha')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="refe" class="form-label">Referencia</label>
                            <input type="text" class="form-control" id="refe" placeholder="Ingrese Referencia" wire:model="comprasForm.refe">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="prove" class="form-label">Proveedor</label>
                            <input type="text" class="form-control" id="prove" placeholder="Ingrese Proveedor" wire:model="comprasForm.refe">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="almacen" class="form-label">Almacen</label>
                            <input type="text" class="form-control" id="almacen" placeholder="Ingrese Almacen" wire:model="comprasForm.refe">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="estado" placeholder="Ingrese Estado" wire:model="comprasForm.refe">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" class="form-control" id="total" placeholder="Ingrese Total" wire:model="comprasForm.refe">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="pagado" class="form-label">Pagado</label>
                            <input type="text" class="form-control" id="pagado" placeholder="Ingrese Monto Pagado" wire:model="comprasForm.refe">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="debido" class="form-label">Debido</label>
                            <input type="text" class="form-control" id="debido" placeholder="Ingrese Monto Debido" wire:model="comprasForm.refe">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="estado" class="form-label">Estado de Pago</label>
                            <input type="text" class="form-control" id="estado" placeholder="Ingrese Estado de Pago" wire:model="comprasForm.refe">
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formularioCompra" class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
</div>
