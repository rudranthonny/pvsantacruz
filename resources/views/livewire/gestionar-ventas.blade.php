<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!--titulo-->
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Lista de Compras</span> Compras | Lista de Compras
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
    <!--cuerpo-->
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
                                <label class="visually-hidden" for="buscar_compras">Buscar Compra</label>
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
                                            <th>Almacen</th>
                                            <th>Cliente</th>
                                            <th>Impuesto</th>
                                            <th>Descuento</th>
                                            <th>Envio</th>
                                            <th>Total a Pagar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($posventas as $pventa)
                                            <tr class="text-center">
                                                <td style="vertical-align: middle;">{{ $compra->fecha }}</td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-9">
                                {{ $posventas->links() }}
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
                </div>
            </div>
        </div>
    @script
    <script>
        $wire.on('cerrar_modal_posventa', reservacion => {
            ventana = document.getElementById('cerrar_modal_posventa_x').click();
        });
    </script>
    @endscript
</div>
