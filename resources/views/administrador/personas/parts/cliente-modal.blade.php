<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalCliente">
    Modal Cliente
</button>

<!-- Modal -->
<div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modalClienteLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalClienteLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_cliente_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar_cliente" id="formularioCliente">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="name" class="form-label">Nombre del Cliente <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Ingrese Nombre del Cliente"
                                required wire:model="clientesForm.name">
                            @error('clientesForm.name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12">
                            <label for="email" class="form-label">Nit</label>
                            <input type="text" class="form-control" id="nit" placeholder="Ingrese Nit" wire:model="clientesForm.nit">
                        </div>
                        <div class="col-sm-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Ingrese Email" wire:model="clientesForm.email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="tel" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="tel" placeholder="Ingrese Teléfono" wire:model="clientesForm.telefono">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="pais" class="form-label">País</label>
                            <input type="text" class="form-control" id="pais" placeholder="Ingrese País" wire:model="clientesForm.pais">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" placeholder="Ingrese Ciudad" wire:model="clientesForm.ciudad">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formularioCliente" class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('cerrar_modal_cliente', reservacion => {
            ventana = document.getElementById('cerrar_modal_cliente_x').click();
        });
    </script>
@endscript
