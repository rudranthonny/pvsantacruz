<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalProductoAlmacen">
    Modal Unidades
</button>

<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="modalProductoAlmacen" tabindex="-1" aria-labelledby="modalProductoAlmacenLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalProductoAlmacenLabel">{{ $titlemodal }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_producto_almacen_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioUnidad">
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="nombre" class="form-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="name"
                                required wire:model="almacenstockform.stock">
                            @error('almacenstockform.stock')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="nombre" class="form-label">Descripción <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" wire:model="descripcion">
                            @error('descripcion')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </form>
                @if (isset($almacenstockform->productoalmacen->id))
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Valor Anterior</th>
                                    <th class="text-center">Valor Nuevo</th>
                                    <th class="text-center">Descripción</th>
                                </tr>
                            </thead>
                            <tbody class="table-primary">
                                @foreach ($almacenstockform->productoalmacen->malmacens->sortByDesc('created_at') as $malmacen)
                                <tr>
                                    <td class="text-center">{{$malmacen->created_at}}</td>
                                    <td class="text-center">{{$malmacen->valor_anterior}}</td>
                                    <td class="text-center">{{$malmacen->valor_nuevo}}</td>
                                    <td class="text-center">{{$malmacen->descripcion}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" wire:loading.attr='disabled' wire:target='guardar' form="formularioUnidad" class="btn btn-primary">{{ $titlemodal }}</button>
            </div>
        </div>
    </div>
</div>
