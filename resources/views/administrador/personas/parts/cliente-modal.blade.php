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
                        <div class="col-12 mb-2">
                            <label for="tdocumento_id"><b>Tipo de Documentos</b> <span class="text-danger">*</span></label>
                            <select class="form-select" id="tdocumento_id" wire:model.live="clientesForm.tdocumento_id">
                                <option value="">Elegir</option>
                                @foreach ($documentos as $doc)
                                <option value="{{$doc->id}}">{{$doc->nombre}}</option>
                                @endforeach
                            </select>
                            @error('clientesForm.tdocumento_id')
                            <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label for="clientesForm_numero_documento" class="form-label"><b>Numero Documento</b></label><br>
                            <div class="input-group">
                                <input type="text" class="form-control" id="clientesForm_numero_documento" autocomplete="off" placeholder="Ingresar Numero del Documento" wire:model.live="clientesForm.nit">
                                <div class="input-group-text" wire:loading.attr="disabled" wire:target="buscar_documento" wire:click="buscar_documento()">
                                    <i class="bi bi-search"></i> <span class="text-danger">*</span>
                                </div>
                            </div>
                            @error('clientesForm.nit')
                            <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-2">
                            <label for="name" class="form-label"><b>Nombre del Cliente</b> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Ingrese Nombre del Cliente"
                                required wire:model="clientesForm.name">
                            @error('clientesForm.name')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label for="email" class="form-label"><b>Email</b></label>
                            <input type="text" class="form-control" id="email" placeholder="Ingrese Email" wire:model="clientesForm.email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="tel" class="form-label"><b>Teléfono</b></label>
                            <input type="text" class="form-control" id="tel" placeholder="Ingrese Teléfono" wire:model="clientesForm.telefono">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="pais" class="form-label"><b>País</b></label>
                            <input type="text" class="form-control" id="pais" placeholder="Ingrese País" wire:model="clientesForm.pais">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="ciudad" class="form-label"><b>Ciudad</b></label>
                            <input type="text" class="form-control" id="ciudad" placeholder="Ingrese Ciudad" wire:model="clientesForm.ciudad">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="dirección" class="form-label"><b>Dirección</b></label>
                            <input type="text" class="form-control" id="dirección" placeholder="Ingrese Ciudad" wire:model="clientesForm.direccion">
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
