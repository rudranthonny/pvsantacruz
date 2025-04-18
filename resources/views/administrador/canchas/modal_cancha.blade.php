<div wire:ignore.self class="modal fade" id="modal_crear_actualizar_cancha" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{ $titulo_cancha }} Cancha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="cerrar_modal_cancha_x"></button>
            </div>

            <div class="modal-body">
                <div class="col-12 mb-3">
                    <label class="form-label">Nombre de la Cancha</label>
                    <input type="text" class="form-control" wire:model.defer="canchaform.name">
                    @error('canchaform.name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Costo de la Cancha</label>
                    <input type="number" step="0.01" class="form-control" wire:model.defer="canchaform.costo">
                    @error('canchaform.costo') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Almacen</label>
                    <select name="canchaform_almacen_id" id="canchaform_almacen_id"  class="form-control" wire:model.defer="canchaform.almacen_id">
                        <option value="">Elegir</option>
                        @foreach ($almacenes as $alm)
                        <option value="{{$alm->id}}">{{$alm->nombre}}</option>
                        @endforeach
                    </select>
                    @error('canchaform.almacen_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button wire:click="save_cancha"
                        wire:loading.attr="disabled"
                        class="btn btn-primary">
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    @script
    <script>
        $wire.on('cerrar_modal_cancha', () => {
            document.getElementById('cerrar_modal_cancha_x').click();
        });
    </script>
    @endscript
</div>
