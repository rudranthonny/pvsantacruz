<div>
    <div class="row">
        <div class="col-sm-6 col-12 mb-3">
            <label for="">Elegir Almacen</label>
            <select name="almacen" id="" class="form-select" wire:model.live='salmacen'>
                    <option value="">Elegir</option>
                    @foreach ($almacens as $almacen)
                    <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                    @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 mb-3" >

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3" role="button" data-bs-toggle="modal">
                    <div class="d-flex justify-content-center align-items-center p-4 bg-success  rounded-3">
                        <span class="display-6 lh-1 text-blue mb-0"><i style="color:black;" class="fas fa-shopping-cart"></i></span>
                        <div class="ms-4 h6 fw-normal mb-0">
                            <div class="d-flex">
                                <h5 class="purecounter mb-0 fw-bold">Ventas</h5>
                            </div>
                            <p class="mb-0">{{$configuracion->moneda->simbolo}} {{$monto_ventas}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3" role="button" data-bs-toggle="modal">
                    <div class="d-flex justify-content-center align-items-center p-4 bg-warning  rounded-3">
                        <span class="display-6 lh-1 text-blue mb-0"><i style="color:black;" class="fas fa-plus-circle"></i></span>
                        <div class="ms-4 h6 fw-normal mb-0">
                            <div class="d-flex">
                                <h5 class="purecounter mb-0 fw-bold">Compras</h5>
                            </div>
                            <p class="mb-0">{{$configuracion->moneda->simbolo}} {{$monto_compras}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3" role="button" data-bs-toggle="modal">
                    <div class="d-flex justify-content-center align-items-center p-4 bg-info  rounded-3">
                        <span class="display-6 lh-1 text-blue mb-0"><i style="color:black;" class="fas fa-minus-circle"></i></span>
                        <div class="ms-4 h6 fw-normal mb-0">
                            <div class="d-flex">
                                <h5 class="purecounter mb-0 fw-bold">Gastos</h5>
                            </div>
                            <p class="mb-0">{{$configuracion->moneda->simbolo}} {{$monto_gastos}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3" role="button">
                    <div class="d-flex justify-content-center align-items-center p-4 bg-danger  rounded-3">
                        <span class="display-6 lh-1 text-blue mb-0"><i style="color:black;" class="fas fa-user"></i></span>
                        <div class="ms-4 h6 fw-normal mb-0">
                            <div class="d-flex">
                                <h5 class="purecounter mb-0 fw-bold">Deuda a Cobrar</h5>
                            </div>
                            <p class="mb-0">{{$configuracion->moneda->simbolo}} {{$monto_deuda}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
         @can('admin.canchas')
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <x-adminlte-info-box title="Canchas" text="Gestión Canchas" icon="fas fa-futbol"
                theme="danger" url="{{ route('admin.canchas') }}" />
        </div>
        @endcan
        <!-- Tarjeta Categoria Gastos -->
        @can('admin.reservas')
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <x-adminlte-info-box title="Gestionar" text="Reporte Reservas" icon="fas fa-list"
                theme="danger" url="{{ route('admin.reservas_reporte') }}" />
        </div>
        @endcan
    </div>
    <div class="row my-2">
        <div class="col-12 col-sm-8">
            <div class="card">
                <div class="card-body">
                    <b>Alerta de stock:</b> {{$productos_almacen->total()}}
                    <hr>
                    <div class="col-12 table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>Producto</th>
                                <th>Almacen</th>
                                <th>Stock</th>
                                <th>Stock Limite</th>
                                <th>Marca</th>
                                <th>Categoría</th>
                                <th>Estado</th>
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
                                        @isset($palmacen->producto->marca)
                                        {{ $palmacen->producto->marca->name }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($palmacen->producto->categoria)
                                        {{ $palmacen->producto->categoria->name }}
                                        @endisset
                                    </td>
                                    <td>
                                        @if ($palmacen->stock == 0)
                                            <span class="badge text-bg-danger">Insuficiente</span>
                                        @elseif (
                                        $palmacen->stock > 0
                                                &&
                                        $palmacen->stock <=2
                                        )
                                            <span class="badge text-bg-warning">Por Acabar</span>
                                        @elseif ($palmacen->stock >= 3 && $palmacen->stock <= $palmacen->producto->alerta_stock)
                                            <span class="badge text-bg-success">Suficiente</span>
                                        @elseif ($palmacen->stock > $palmacen->producto->alerta_stock )
                                        <span class="badge text-bg-info">Exceso</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <br>
                    {{ $productos_almacen->links() }}
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-12">
                                <div wire:ignore id="model-grafico">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card">
                <div class="card-body">
                    Productos que generaron mas Ingresos <b>({{date('M')}})</b>
                    <hr>
                    <div class="col-12 table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>Nombre del producto	</th>
                                    <th>Venta Totales</th>
                                    <th>Monto Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos_vendidos as $dey => $pvendido)
                                    @if ($dey <= 4)
                                    <tr class="text-center">
                                        <td>{{$productos_vendidos[$dey]['producto_nombre']}}</td>
                                        <td>{{$productos_vendidos[$dey]['venta_totales']}}</td>
                                        <td>{{$productos_vendidos[$dey]['monto']}}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="model-grafico2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
