<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalUnidad">
    Modal Unidades
</button>

<!-- Modal -->
<div class="modal fade" id="modalUnidad" tabindex="-1" aria-labelledby="modalUnidadLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalUnidadLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_unidad_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioUnidad">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Ingrese Nombre de Unidad"
                                required wire:model="unidadesForm.name">
                            @error('unidadesForm.name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="nombre_cor" class="form-label">Nombre Corto</label>
                            <input type="text" class="form-control" id="nombre_cor" placeholder="Ingrese Nombre Corto" wire:model="unidadesForm.name_cor">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="unidadb" class="form-label">Unidad Base</label>
                            <input type="text" class="form-control" id="unidadb" placeholder="Ingrese Unidad Base" wire:model="unidadesForm.unidadb">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="operador" class="form-label">Operador</label>
                            <input type="text" class="form-control" id="operador" placeholder="Ingrese Operador" wire:model="unidadesForm.operador">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="valor" class="form-label">Valor de Operación</label>
                            <input type="text" class="form-control" id="valor" placeholder="Ingrese Valor de Operación" wire:model="unidadesForm.valor">
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
