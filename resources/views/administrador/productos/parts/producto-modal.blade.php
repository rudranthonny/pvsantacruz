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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="cerrar_modal_producto_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioProducto">

                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="designacion" class="form-label">Designacion <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="designacion"
                                placeholder="Ingrese Designacion" required wire:model="productoForm.designacion">
                            @error('productoForm.designacion')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="precio" class="form-label">Precio </label>
                            <input type="text" class="form-control" id="precio" placeholder="Ingrese Precio"
                                wire:model="productoForm.precio">
                            @error('productoForm.precio')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="tipo" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="tipo" placeholder="Ingrese Tipo"
                                wire:model="productoForm.tipo">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="codigo" class="form-label">Codigo</label>
                            <input type="text" class="form-control" id="codigo" placeholder="Ingrese Codigo"
                                wire:model="productoForm.codigo">
                            @error('productoForm.codigo')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="cantidad" class="form-label">Cantidad </label>
                            <input type="text" class="form-control" id="cantidad" placeholder="Ingrese Cantidad"
                                wire:model="productoForm.cantidad">
                            @error('productoForm.cantidad')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="categoria_id" class="form-label">Categoria</label>
                            <select class="form-control" id="categoria_id" wire:model="productoForm.categoria_id">
                                @forelse ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                @empty
                                    <option value="">Sin Categorias</option>
                                @endforelse
                            </select>
                            @error('productoForm.categoria_id')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="marca_id" class="form-label">Marca</label>
                            <select class="form-control" id="marca_id" wire:model="productoForm.marca_id">
                                @forelse ($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                                @empty
                                    <option value="">Sin Marcas</option>
                                @endforelse
                            </select>
                            @error('productoForm.marca_id')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="unidad_id" class="form-label">Unidad</label>
                            <select class="form-control" id="unidad_id" wire:model="productoForm.unidad_id">
                                @forelse ($unidades as $unidad)
                                    <option value="{{ $unidad->id }}">{{ $unidad->name }}</option>
                                @empty
                                    <option value="">Sin Marcas</option>
                                @endforelse
                            </select>
                            @error('productoForm.unidad_id')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="simbologia" class="form-label">Simbología de códigos de barras</label>
                        <br>
                        <select id="simbologia">
                            <option value="1">Code 128</option>
                            <option value="2">Code 39</option>
                            <option value="3">EAN8</option>
                            <option value="4">EAN13</option>
                            <option value="5">UPC</option>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="imagen-{{ $iteration }}"
                                placeholder="Ingrese Imagen" wire:model.live="imagen_producto">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formularioProducto"
                    class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
</div>
