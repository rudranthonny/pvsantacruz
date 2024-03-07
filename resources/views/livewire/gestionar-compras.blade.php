<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!--titulo-->
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Lista de Compras</span> Compras | Lista de Compras
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
                            <span><b>Listado de Compras</b></span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalCompra" wire:click='modal'><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="visually-hidden" for="buscar_compras">Username</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    <input type="text" class="form-control" id="buscar_compras"
                                        placeholder="Buscar Compra" wire:model.live='search'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>Fecha</th>
                                            <th>Referencia</th>
                                            <th>Proveedor</th>
                                            <th>Almacen</th>
                                            <th>Estado</th>
                                            <th>Total</th>
                                            <th>Pagado</th>
                                            <th>Debido</th>
                                            <th>Estado de Pago</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($compras as $compra)
                                            <tr class="text-center">
                                                <td>{{ $compra->fecha }}</td>
                                                <td>{{ $compra->refe }}</td>
                                                <td>{{ $compra->prove }}</td>
                                                <td>{{ $compra->almacen }}</td>
                                                <td>{{ $compra->estado }}</td>
                                                <td>{{ $compra->total }}</td>
                                                <td>{{ $compra->pagado }}</td>
                                                <td>{{ $compra->debido }}</td>
                                                <td>{{ $compra->estado_pago }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#modalCompra"
                                                        wire:click="modal('{{ $compra->id }}')"><i
                                                            class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger"
                                                        wire:click="eliminar({{ $compra->id }})"
                                                        id="eliminar-compra-{{ $compra->id }}"
                                                        wire:confirm="Estas seguro de Eliminar esta Compra?">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
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
                                {{ $compras->links() }}
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
                    @include('administrador.compras.parts.compra-modal')
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('cerrar_modal_compra', reservacion => {
            ventana = document.getElementById('cerrar_modal_compra_x').click();
        });
    </script>
@endscript
