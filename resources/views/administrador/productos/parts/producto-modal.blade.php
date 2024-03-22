<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalProducto">
    Modal Producto
</button>

<!-- Modal -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalProductoLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalProductoLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="cerrar_modal_producto_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioProducto">

                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="designacion" class="form-label">Designacion <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="designacion"
                                placeholder="Ingrese Designacion" wire:model="productoForm.designacion">
                            @error('productoForm.designacion')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="simbologia">Simbología de códigos de barras<span  class="text-danger">*</span></label>
                            <select id="simbologia"  class="form-select" wire:model="productoForm.simbologia">
                                <option value="">Elegir</option>
                                <option value="1">Code 128</option>
                                <option value="2">Code 39</option>
                                <option value="3">EAN8</option>
                                <option value="4">EAN13</option>
                                <option value="5">UPC</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="codigo" class="form-label">Codigo <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="codigo" placeholder="Escribir Codigo"wire:model="productoForm.codigo">
                                <div class="input-group-text"  wire:click='generar_codigo'><i class="fas fa-barcode"></i></div>
                            </div>
                            @error('productoForm.codigo')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="marca_id" class="form-label">Marca</label>
                            <select class="form-control" id="marca_id" wire:model="productoForm.marca_id">
                                <option value="">Elegir</option>
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
                        <div class="col-12 col-sm-4">
                            <label class="form-label" for="impuesto_orden">Impuesto de orden</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="impuesto_orden" placeholder="0" wire:model.live.debounce.500ms="productoForm.impuesto_orden">
                                <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                                <label for="metodo_impuesto">Metodo de Impuesto<span style="color:red;">*</span></label>
                                <select class="form-select" id="metodo_impuesto" wire:model="productoForm.metodo_impuesto">
                                    <option value="">Elegir</option>
                                    <option value="exclusivo">Exclusivo</option>
                                    <option value="inclusivo">Inclusivo</option>
                                </select>
                                @error('productoForm.metodo_impuesto')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="categoria_id" class="form-label">Categoria<span style="color:red;">*</span></label>
                            <select class="form-select" id="categoria_id" wire:model="productoForm.categoria_id">
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
                        <div class="col-sm-12">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" rows="3"  wire:model="productoForm.descripcion"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <label for="metodo_impuesto">Tipo<span style="color:red;">*</span></label>
                            <select class="form-select" id="metodo_impuesto" wire:model="productoForm.tipo">
                                <option value="">Elegir</option>
                                <option value="estandar">Producto Estandar</option>
                                <option value="servicio">Producto Servicio</option>
                            </select>
                            @error('productoForm.tipo')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="costo" class="form-label">Costo del Producto <span style="color:red;">*</span></label>
                            <input type="number" class="form-control" step="0.01" id="costo"
                                wire:model="productoForm.costo">
                            @error('productoForm.costo')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="precio" class="form-label">Precio del Producto <span style="color:red;">*</span></label>
                            <input type="number" class="form-control" step="0.01" id="precio"
                                wire:model="productoForm.precio">
                            @error('productoForm.precio')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="producto_unitario">Producto Unitario<span style="color:red;">*</span></label>
                            <select class="form-select" id="producto_unitario" wire:model="productoForm.unitario">
                                <option value="">Elegir</option>
                                @foreach ($unidades as $uni)
                                    <option value="{{$uni->id}}">{{$uni->name}}</option>
                                @endforeach
                            </select>
                            @error('productoForm.unitario')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="producto_venta_unidad">Venta de Unidades<span style="color:red;">*</span></label>
                            <select class="form-select" id="producto_venta_unidad" wire:model="productoForm.venta_unidad">
                                <option value="">Elegir</option>
                                @foreach ($unidades as $uni)
                                    <option value="{{$uni->id}}">{{$uni->name}}</option>
                                @endforeach
                            </select>
                            @error('productoForm.venta_unidad')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="producto_venta_unidad">Compra de Unidad<span style="color:red;">*</span></label>
                            <select class="form-select" id="producto_compra_unidad" wire:model="productoForm.compra_unidad">
                                <option value="">Elegir</option>
                                @foreach ($unidades as $uni)
                                <option value="{{$uni->id}}">{{$uni->name}}</option>
                                @endforeach
                            </select>
                            @error('productoForm.venta_unidad')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="alerta_stock" class="form-label">Alerta stock </label>
                            <input type="number" class="form-control" id="alerta_stock"
                                wire:model="productoForm.alerta_stock">
                            @error('productoForm.alerta_stock')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
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
