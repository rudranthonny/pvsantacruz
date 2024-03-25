<div>
    <div class="row">
        <div class="col-5">
            <div class="card text-center">
                <div class="card-header">
                    <div class="row justify-content-between" style="text-align: right;">
                        <div class="col-auto">
                            <a href="{{ route('admin.index') }}">
                                <img src="{{ asset('imagenes/logo.png') }}" alt="" width="64px;">
                            </a>
                        </div>
                        <div class="col-auto">
                            <img src="{{ asset('imagenes/logo.png') }}" alt="" width="64px;">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 my-1">
                            <div class="input-group">
                                <input type="text" class="form-control" id="usuariosform_username"
                                    placeholder="Escribir Usuario" wire:model.live="usuariosform.username">
                                <div class="input-group-text"><i class="bi bi-person-add"></i> <span
                                        class="text-danger">*</span></div>
                            </div>
                        </div>
                        <div class="col-12 my-1">
                            <select class="form-select" id="compra_almacen" wire:model.live="almacen_id">
                                <option value="">Elegir</option>
                                @forelse ($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 my-1">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 my-1">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="table-success">
                                        <th>Nombre del Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total Parcial</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $key => $item)
                                        <tr class="align-middle">
                                            <td>
                                                {{ $item['codigo'] }}
                                                <br>
                                                <span class="badge text-bg-success">{{ $item['designacion'] }}</span> <i
                                                    style="color:green;" class="bi bi-pencil-square"></i>
                                            </td>
                                            <td>{{ $item['precio'] }}</td>
                                            <td>
                                                @php $valor_cantidad = 'items.'.$key.'.cantidad';@endphp
                                                <center><input type="number" class="form-control" style="width: 80px;"
                                                        min=1 wire:model.live='{{ $valor_cantidad }}'>
                                                </center>
                                            </td>
                                            <td>{{ $item['importe'] }}</td>
                                            <td><i style="color:red;font-size: 24px;" class="bi bi-x-circle"
                                                    role="button"
                                                    wire:click="eliminaritem('{{ $key }}')"></i>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">
                                                Datos no Disponibles
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 my-1">
                            <div class="row">
                                <div class="col-sm-4 col-12">
                                    <label for="impuesto" class="form-label"><b>Impuesto</b></label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-percent"></i></div>
                                        <input type="number" class="form-control" min=0 id="impuesto" placeholder="0"
                                            wire:model.live="impuesto_porcentaje">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <label for="descuento" class="form-label"><b>Descuento</b></label>
                                    <div class="input-group">
                                        <div class="input-group-text">S/</div>
                                        <input type="number" class="form-control" min=0 id="descuento" placeholder="0"
                                            wire:model.live="descuento">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <label for="envio" class="form-label"><b>Envió</b></label>
                                    <div class="input-group">
                                        <div class="input-group-text">S/ </div>
                                        <input type="number" class="form-control" min=0 id="envio" placeholder="0"
                                            wire:model.live="envio">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12 col-sm-6">
                            <button class="btn btn-success btn-lg" wire:click="$refresh">Reiniciar</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <button class="btn btn-danger btn-lg" data-bs-toggle="modal"
                                data-bs-target="#agregarPagoPosModal">Pagar Ahora</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-12 col-sm-6 my-1">
                            <label for="categoria"><b>Categoria</b></label>
                            <select class="form-select" id="categoria" wire:model.live="categoria_id">
                                <option value="">Todos</option>
                                @forelse ($categorias as $categoria)
                                    <option value="{{ $categoria->cat_cod }}">{{ $categoria->name }}</option>
                                @empty
                                    <option value="">Sin Categorias</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 my-1">
                            <label for="marca"><b>Marcas</b></label>
                            <select class="form-select" id="marca" wire:model.live="marca_id">
                                <option value="">Todos</option>
                                @forelse ($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->name }}</option>
                                @empty
                                    <option value="">Sin Marcas</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-12 my-2">
                            <label class="visually-hidden" for="buscar_proveedor">Buscar Producto</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-search"></i></div>
                                <input type="text" class="form-control" id="buscar_proveedor"
                                    placeholder="Buscar Proveedor" wire:model.live="search">
                            </div>
                        </div>
                    </div>
                    <!--lista de producto-->
                    <div class="row my-2">
                        @forelse ($productos as $product)
                            <div class="col-2" role="button" wire:key="{{ $product->id }}"
                                wire:click="agregaritem('{{ $product->id }}')">
                                <div class="card">
                                    <img src="{{ asset($product->producto->imagen) }}" style="object-fit: cover;"
                                        height="80px;" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 m-0 p-0" style="padding: 0px;">
                                                {{ $product->producto->designacion }}<br>
                                                {{ $product->producto->codigo }}<br>
                                                <span
                                                    class="badge text-bg-warning">{{ number_format($product->producto->precio, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            @if ($productoscompuestos->count() == 0)
                                <span>SIN PRODUCTOS</span>
                            @endif
                        @endforelse
                        @forelse ($productoscompuestos as $productoscompuesto)
                            <div class="col-2" role="button" wire:key="{{ $productoscompuesto->id }}"
                                wire:click="agregaritem('{{ $productoscompuesto->id }}')">
                                <div class="card">
                                    <img src="{{ asset($productoscompuesto->imagen) }}" style="object-fit: cover;"
                                        height="80px;" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 m-0 p-0" style="padding: 0px;">
                                                {{ $productoscompuesto->designacion }}<br>
                                                {{ $productoscompuesto->codigo }}<br>
                                                <span
                                                    class="badge text-bg-warning">{{ number_format($productoscompuesto->precio, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <span></span>
                        @endforelse
                    </div>
                    <!--paginacion-->
                    <div class="row my-2">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.modal.pos-modal')
</div>
