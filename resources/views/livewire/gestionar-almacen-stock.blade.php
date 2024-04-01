<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!--titulo-->
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Almacen</span> Productos | Almacen
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
    <!--cuerpo-->
    <div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><b>Listado de Unidades</b></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12 col-sm-6">
                                <label  for="buscar_productos">Buscar Producto</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    <input type="text" class="form-control" id="buscar_productos"
                                        placeholder="Buscar Productos" wire:model.live='search'>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <label for="seleccionar_almacen">Seleccionar Almacen</label>
                                <select class="form-select" id="seleccionar_almacen" wire:model.live="salmacen">
                                        <option value="">Elegir</option>
                                    @foreach ($almacens as $almacen)
                                        <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-3">
                                <label for="seleccionar_almacen">Estado del Producto</label>
                                <select class="form-select" id="seleccionar_almacen" wire:model.live="sestado">
                                        <option value="">Elegir</option>
                                        <option value="suficiente">Suficiente</option>
                                        <option value="poracabar">Por Acabar</option>
                                        <option value="insuficiente">Insuficiente</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>Producto</th>
                                            <th>Almacen</th>
                                            <th>Stock</th>
                                            <th>Stock Limite</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($productos_almacen as $palmacen)
                                            <tr class="text-center">
                                                <td>{{ $palmacen->producto->designacion }}</td>
                                                <td>{{ $palmacen->almacen->nombre }}</td>
                                                <td>{{ $palmacen->stock }}</td>
                                                <td>{{ $palmacen->producto->alerta_stock }}</td>
                                                <td>
                                                    @if ($palmacen->stock < $palmacen->producto->alerta_stock)
                                                        <span class="badge text-bg-danger">Insuficiente</span>
                                                    @elseif (
                                                    $palmacen->stock > $palmacen->producto->alerta_stock
                                                            &&
                                                    $palmacen->stock < ($palmacen->producto->alerta_stock+10)
                                                    )
                                                        <span class="badge text-bg-warning">Por Acabar</span>
                                                    @elseif ($palmacen->stock > $palmacen->producto->alerta_stock)
                                                        <span class="badge text-bg-success">Suficiente</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#modalProductoAlmacen"
                                                        wire:click="modal('{{ $palmacen->id }}')"><i
                                                            class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-9">
                                {{ $productos_almacen->links() }}
                            </div>
                            <div class="col-12 col-sm-3" style="text-align: right;" wire:model.live='pagina'>
                                <select class="form-select">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="100">100</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    @include('administrador.almacen.parts.producto-almacen-modal')
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('cerrar_modal_producto_almacen', reservacion => {
            ventana = document.getElementById('cerrar_modal_producto_almacen_x').click();
        });
    </script>
@endscript
