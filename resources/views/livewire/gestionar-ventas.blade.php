<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!--titulo-->
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Lista de Ventas</span> Compras | Lista de Ventas
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
                            <span><b>Listado de Ventas</b></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12 col-sm-3">
                                <label  for="buscar_compras">Buscar Venta</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    <input type="text" class="form-control" id="buscar_venta"
                                        placeholder="Buscar Venta" wire:model.live='search'>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <label for="seleccionar_almacen" class="form-label">Almacen</label>
                                <select class="form-select" id="seleccionar_almacen" wire:model.live="salmacen">
                                    <option value="">Elegir</option>
                                    @foreach ($almacens as $almacen)
                                    <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-3">
                                <label for="f_inicio">F.Inicio</label>
                                <input type="date" id="f_inicio" class="form-control" wire:model.live='finicio'>
                            </div>
                            <div class="col-12 col-sm-3">
                                <label for="f_inicio">F.Final</label>
                                <input type="date" id="f_final" class="form-control" wire:model.live='ffinal'>
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
                                            <th>Impuesto Porcentaje</th>
                                            <th>Impuesto</th>
                                            <th>Descuento</th>
                                            <th>Envio</th>
                                            <th>Total a Pagar</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($posventas as $pventa)
                                            <tr class="text-center">
                                                <td style="vertical-align: middle;">{{ $pventa->created_at }}</td>
                                                <td style="vertical-align: middle;">{{ $pventa->almacen_name }}</td>
                                                <td style="vertical-align: middle;">{{ $pventa->cliente_name }}</td>
                                                <td style="vertical-align: middle;">{{ $pventa->impuesto_porcentaje }}%</td>
                                                <td style="vertical-align: middle;">{{ $configuracion->moneda->simbolo.$pventa->impuesto_monto }}</td>
                                                <td style="vertical-align: middle;">{{ $configuracion->moneda->simbolo.$pventa->descuento }}</td>
                                                <td style="vertical-align: middle;">{{ $configuracion->moneda->simbolo.$pventa->envio }}</td>
                                                <td style="vertical-align: middle;">{{ $configuracion->moneda->simbolo.$pventa->total_pagar }}</td>
                                                <td style="vertical-align: middle;">-</td>
                                            </tr>
                                        @empty
                                        @endforelse
                                            <tr>
                                                <td colspan="4" class="table-dark text-center">
                                                    Total
                                                </td>
                                                <td class="text-center table-success">{{$configuracion->moneda->simbolo.$posventas->sum('impuesto_monto')}}</td>
                                                <td class="text-center table-success">{{$configuracion->moneda->simbolo.$posventas->sum('descuento')}}</td>
                                                <td class="text-center table-success">{{$configuracion->moneda->simbolo.$posventas->sum('envio')}}</td>
                                                <td class="text-center table-success">{{$configuracion->moneda->simbolo.$posventas->sum('total_pagar')}}</td>
                                                <td class="text-center table-dark"></td>
                                            </tr>
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
