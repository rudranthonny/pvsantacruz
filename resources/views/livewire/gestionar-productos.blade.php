<div>
    <!--titulo-->
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Lista de Productos </span> Productos | Lista de Productos
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
                            <span><b>Listado de Productos</b></span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalProducto" wire:click='modal'><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="visually-hidden" for="buscar_producto">Producto</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    <input type="text" class="form-control" id="buscar_producto"
                                        placeholder="Buscar Producto" wire:model.live='search'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <caption class="caption-top">Lista de Productos</caption>
                                    <thead class="table-light">
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Tipo</th>
                                            <th>Designacion</th>
                                            <th>Codigo</th>
                                            <th>Marca</th>
                                            <th>Categoria</th>
                                            <th>Precio</th>
                                            <th>Unidad</th>
                                            <th>Cantidad</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($productos as $producto)
                                            <tr>
                                                <td>{{ $producto->imagen }}</td>
                                                <td>{{ $producto->tipo }}</td>
                                                <td>{{ $producto->designacion }}</td>
                                                <td>{{ $producto->codigo }}</td>
                                                <td>{{ $producto->marca }}</td>
                                                <td>{{ $producto->categoria }}</td>
                                                <td>{{ $producto->precio }}</td>
                                                <td>{{ $producto->unidad }}</td>
                                                <td>{{ $producto->cantidad }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#modalProducto"
                                                        wire:click="modal('{{ $producto->id }}')"><i
                                                            class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger"
                                                        wire:click="eliminar({{ $producto->id }})"
                                                        id="eliminar-producto-{{ $producto->id }}"
                                                        wire:confirm="Estas seguro de Eliminar esta Producto">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <td>Imagen</td>
                                            <td>Tipo</td>
                                            <td>Designacion</td>
                                            <td>Codigo</td>
                                            <td>Marca</td>
                                            <td>Categoria</td>
                                            <td>Precio</td>
                                            <td>Unidad</td>
                                            <td>Cantidad</td>
                                            <td>Accion</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-9">
                                {{ $productos->links() }}
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
                    @include('administrador.productos.parts.producto-modal')
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $wire.on('cerrar_modal_producto', reservacion => {
            ventana = document.getElementById('cerrar_modal_producto_x').click();
        });
    </script>
@endscript
