<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalCaja">
    Modal Caja
</button>

<!-- Modal -->
<div class="modal fade" id="modalCaja" tabindex="-1" aria-labelledby="modalCajaLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCajaLabel">Aperturar Caja</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_caja_x"></button>
            </div>
            <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="cajaform_monto_apertura" class="form-label">Monto de Apertura</label>
                            <input type="number" step="0.01" class="form-control" id="cajaform_monto_apertura" wire:model="cajaform.monto_apertura">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click='crear_caja'>Aperturar Caja</button>
            </div>
        </div>
    </div>
</div>
