<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalProducto">
    Modal Producto
</button>

<!-- Modal -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalProductoLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalProductoLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_producto_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioProducto">

                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="designacion" class="form-label">Designacion <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="designacion" placeholder="Ingrese Designacion"
                                required wire:model="productoForm.designacion">
                            @error('productoForm.designacion')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="imagen-{{$iteration}}" placeholder="Ingrese Imagen" wire:model.live="imagen_producto">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="tipo" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="tipo" placeholder="Ingrese Tipo" wire:model="productoForm.tipo">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="codigo" class="form-label">Codigo</label>
                            <input type="text" class="form-control" id="codigo" placeholder="Ingrese Codigo" wire:model="productoForm.codigo">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="marca" class="form-label">Marca </label>
                            <input type="text" class="form-control" id="marca" placeholder="Ingrese Marca" wire:model="productoForm.marca">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="categoria" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="categoria"
                                placeholder="Ingrese Categoria" wire:model="productoForm.categoria">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="precio" class="form-label">Precio </label>
                            <input type="text" class="form-control" id="precio" placeholder="Ingrese Precio" wire:model="productoForm.precio">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="unidad" class="form-label">Unidad</label>
                            <input type="text" class="form-control" id="unidad"
                                placeholder="Ingrese Unidad" wire:model="productoForm.unidad">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="cantidad" class="form-label">Cantidad </label>
                            <input type="text" class="form-control" id="cantidad" placeholder="Ingrese Cantidad" wire:model="productoForm.cantidad">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formularioProducto" class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
</div>
