<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalMarca">
    Modal Marca
</button>

<!-- Modal -->
<div class="modal fade" id="modalMarca" tabindex="-1" aria-labelledby="modalMarcaLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalMarcaLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_marca_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioMarca">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="nombre" class="form-label">Nombre de la Marca <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombrem" placeholder="Ingrese el Nombre de la Marca"
                                required wire:model="marcasForm.name">
                            @error('marcasForm.name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="descripcion" class="form-label">Descripción Marca</label>
                            <input type="text" class="form-control" id="descm" placeholder="Ingrese Descripción de la Marca" wire:model="marcasForm.description">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="pais" class="form-label">Imagen de la Marca</label>
                            <input type="text" class="form-control" id="simbolo" placeholder="Ingrese Imagen de la Marca" wire:model="marcasForm.image">
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formularioMarca" class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
</div>
