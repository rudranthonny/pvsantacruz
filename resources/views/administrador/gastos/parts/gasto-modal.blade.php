<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalGasto">
    Modal Gastos
</button>

<!-- Modal -->
<div class="modal fade" id="modalGasto" tabindex="-1" aria-labelledby="modalGastoLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalGastoLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_gasto_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioGasto">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="gastoform_fecha" class="form-label">Fecha <span style="color:red">*</span></label>
                            <input type="date" class="form-control" id="gastoform_fecha" placeholder="Ingrese Nombre Corto" wire:model="gastoform.fecha">
                            @error('gastoform.fecha')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="gastoform_almacen_id" class="form-label">Almacen <span style="color:red">*</span></label>
                            <select class="form-select" id="gastoform_almacen_id" wire:model.live='gastoform.almacen_id'>
                                <option value="">Elegir</option>
                                @foreach ($almacens as $alma)
                                <option value="{{$alma->id}}">{{$alma->nombre}}</option>
                                @endforeach
                            </select>
                            @error('gastoform.almacen_id')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="gastoform_tgasto_id" class="form-label">Categorias de Gastos <span style="color:red">*</span></label>
                            <select class="form-select" id="gastoform_tgasto_id" wire:model.live='gastoform.tgasto_id'>
                                <option value="">Elegir</option>
                                @foreach ($tgastos as $tgasto)
                                <option value="{{$tgasto->id}}">{{$tgasto->name}}</option>
                                @endforeach
                            </select>
                            @error('gastoform.tgasto_id')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="gastoform_monto" class="form-label">Monto <span style="color:red">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="gastoform_monto" wire:model="gastoform.monto">
                            @error('gastoform.monto')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="gastoform_detalles" class="form-label">Detalles <span style="color:red">*</span></label>
                            <textarea class="form-control" id="gastoform_detalles" cols="30" rows="10" wire:model="gastoform.detalles"></textarea>
                            @error('gastoform.detalles')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formularioGasto" class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
</div>
