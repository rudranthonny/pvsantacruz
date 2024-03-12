<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalProveedor">
    Modal Proveedor
</button>

<!-- Modal -->
<div class="modal fade" id="modalProveedor" tabindex="-1" aria-labelledby="modalProveedorLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalProveedorLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_proveedor_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioProveedor">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="name" class="form-label">Nombre del Proveedor <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Ingrese Nombre del Proveedor"
                                required wire:model="proveedorForm.name">
                            @error('proveedorForm.name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Ingrese Email" wire:model="proveedorForm.email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="tel" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="tel" placeholder="Ingrese Teléfono" wire:model="proveedorForm.telefono">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="pais" class="form-label">País</label>
                            <input type="text" class="form-control" id="pais" placeholder="Ingrese País" wire:model="proveedorForm.pais">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" placeholder="Ingrese Ciudad" wire:model="proveedorForm.ciudad">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="num" class="form-label">Número de Impuesto</label>
                            <input type="text" class="form-control" id="num" placeholder="Ingrese Número de Impuesto" wire:model="proveedorForm.numero_impuesto">
                        </div>
                    </div><div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="direccion" class="form-label">Dirección</label>
                            <!--<input type="textarea" class="form-control" id="direccion" placeholder="Ingrese Dirección" wire:model="proveedorForm.direccion">-->
                            <textarea label='direccion' rows="4" class="form-label" id="direccion" placeholder="Ingrese Dirección" wire:model="proveedorForm.direccion">
                            </textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formularioProveedor" class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
</div>
