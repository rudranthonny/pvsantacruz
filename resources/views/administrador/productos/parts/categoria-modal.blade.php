<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalCategoria">
    Modal Categorias
</button>

<!-- Modal -->
<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCategoriaLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_categoria_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioCategoria">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="nombre" class="form-label">Categoria de Codigo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cat_cod" placeholder="Ingrese Categoria de Codigo"
                                required wire:model="categoriasasForm.cat_cod">
                            @error('categoriasasForm.cat_cod')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="descripcion" class="form-label">Categoria de Nombre</label>
                            <input type="text" class="form-control" id="nom" placeholder="Ingrese Descripción de la Marca" wire:model="marcasForm.description">
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
