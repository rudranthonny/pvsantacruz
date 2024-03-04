<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalMoneda">
    Modal Moneda
</button>

<!-- Modal -->
<div class="modal fade" id="modalMoneda" tabindex="-1" aria-labelledby="modalMonedaLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalMonedaLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_moneda_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioMoneda">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="nombre" class="form-label">Codigo Moneda <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="codigom" placeholder="Ingrese Codigo Moneda"
                                required wire:model="monedasForm.codigo_moneda">
                            @error('monedasForm.codigo_moneda')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="telefono" class="form-label">Nombre Moneda</label>
                            <input type="text" class="form-control" id="nombrem" placeholder="Ingrese Nombre Moneda" wire:model="monedasForm.nombre_moneda">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="pais" class="form-label">Simbolo</label>
                            <input type="text" class="form-control" id="simbolo" placeholder="Ingrese Simbolo" wire:model="monedasForm.simbolo">
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formularioMoneda" class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
</div>
