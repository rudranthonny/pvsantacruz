<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalProductoAlmacen">
    Modal Unidades
</button>

<!-- Modal -->
<div class="modal fade" id="modalProductoAlmacen" tabindex="-1" aria-labelledby="modalProductoAlmacenLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalProductoAlmacenLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_producto_almacen_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioUnidad">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="nombre" class="form-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="name"
                                required wire:model="almacenstockform.stock">
                            @error('almacenstockform.stock')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formularioUnidad" class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
</div>
