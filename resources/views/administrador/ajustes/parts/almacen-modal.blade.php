<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalAlmacen">
    Modal Almacen
</button>

<!-- Modal -->
<div class="modal fade" id="modalAlmacen" tabindex="-1" aria-labelledby="modalAlmacenLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalAlmacenLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioAlmacen">

                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese Nombre"
                                required wire:model="almacenForm.nombre">
                            @error('content')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="telefono" placeholder="Ingrese Telefono" wire:model="almacenForm.telefono">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="pais" class="form-label">Pais</label>
                            <input type="text" class="form-control" id="pais" placeholder="Ingrese Pais" wire:model="almacenForm.pais">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" placeholder="Ingrese Ciudad" wire:model="almacenForm.ciudad">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="email" class="form-label">Email </label>
                            <input type="email" class="form-control" id="email" placeholder="Ingrese Email" wire:model="almacenForm.email">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="codigoPostal" class="form-label">Codigo Postal</label>
                            <input type="text" class="form-control" id="codigoPostal"
                                placeholder="Ingrese Codigo Postal" wire:model="almacenForm.codigo_postal">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formularioAlmacen" class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
</div>
