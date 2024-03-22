<div>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <label for="nombre" class="form-label">Nombre de la Marca <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nombrem" placeholder="Ingrese el Nombre de la Marca"
                 wire:model="comprasForm.fecha_compra">
            @error('comprasForm.fecha_compra')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        {{$comprasForm->fecha_compra}}
    </div>

    <button type="button" class="btn btn-primary"  id="editar-compra-1"
                                                        wire:click="modal(1)">
        <i class="fas fa-edit"></i>
    </button>
</div>

