<div class="container">
    <!--card de reportes-->
    <div class="row">
        <!--1er Cuadro Filtros-->
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center fw-bold">
                  Filtros para el Reporte de las ventas de los productos
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="form-floating">
                                <input type="date"  class="form-control" id="floatingSelect" aria-label="Floating label select example" wire:model='finicio'>
                                <label for="floatingSelect">Fecha Inicio</label>
                            </div>
                            @error('finicio') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="floatingSelect" aria-label="Floating label select example" wire:model='ffinal'>
                                <label for="floatingSelect">Fecha Final</label>
                            </div>
                            @error('ffinal') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" wire:model='salmacen' aria-label="Floating label select example">
                                  <option value="">Todos</option>
                                  @foreach ($almacens as $almacen)
                                  <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                                  @endforeach
                                </select>
                                <label for="floatingSelect">Elegir Almacen</label>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </div>
        <!--2do Cuadro Filtros-->
        <div class="col-12 my-2">
            <div class="card">
                <div class="card-header text-center fw-bold">
                 Agregar los productos para el reporte
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-4">
                            <div class="form-floating">
                                <input type="input" class="form-control" id="buscar_producto2" wire:model.live="bproducto" aria-label="Floating label select example">
                                <label for="buscar_producto2">Buscar Producto @error('bproducto') <b style="color:red;">{{ $message }}</b> @enderror</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <button class="btn btn-success" wire:click='agregar_producto_compuesto' wire:loading.attr="disabled" wire:target="agregar_producto_compuesto">Agregar Producto</button>
                        </div>
                    </div>
                    @if (count($lista_producto)>0)
                    <div class="row my-2">
                        <div class="col-12 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="table-dark">
                                        <th class="text-center">Nombre del Producto</th>
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lista_producto as $key => $lproducto)
                                    <tr class="table-secondary">
                                        <td class="text-center">{{$lista_producto[$key]['nombre']}}</td>
                                        <td class="text-center">{{$lista_producto[$key]['codigo']}}</td>
                                        <td class="text-center"><button class="btn btn-danger" id="eliminar-{{$key}}" wire:loading.attr="disabled" wire:target="eliminar_item({{$key}})" wire:click='eliminar_item({{$key}})'><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-success" wire:loading.attr="disabled" wire:target="consultar" wire:click='consultar'>Consultar Reporte</button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @if ($consulta_ventas)
        <div class="col-12 my-2">
            <div class="card">
                <div class="card-header text-center fw-bold">
                    Reporte De Ganacias de las Ventas
                </div>
                @if ($consulta_ventas->count()>0)
                <div class="row my-2 container">
                    <div class="col-12 mt-2 table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="table-dark">
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Almacen</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Ventas</th>
                                    <th class="text-center">Descuentos</th>
                                    <th class="text-center">Costo</th>
                                    <th class="text-center">Ganacia</th>
                                </tr>
                            </thead>
                            <tbody class="table-secondary">
                                @foreach ($nombre_productos as $key => $npproducto)
                                    @php
                                    $total_ventas = 0;
                                    $total_costo = 0;
                                    $total_descuento = 0;
                                    $total_cantidad = 0;
                                        foreach ($consulta_ventas->where('producto_id',$key) as $key2 => $ven)
                                        {
                                            $total_cantidad = $total_cantidad+$ven->producto_cantidad;
                                            $total_ventas = $total_ventas+$ven->producto_cantidad*$ven->producto_precio;
                                            $total_costo = $total_costo+$ven->producto_cantidad*$ven->producto_compra;
                                            $total_descuento = $total_descuento + $ven->producto_descuento;
                                        }
                                    @endphp
                                <tr>
                                    <td class="text-center">{{$nombre_productos[$key]['nombre']}}</td>
                                    <td class="text-center">
                                        @if ($salmacen == '')
                                            Todos
                                        @elseif($salmacen <> '')
                                            @if (isset($almacens->where('id',$salmacen)->first()->nombre))
                                                {{$almacens->where('id',$salmacen)->first()->nombre}}
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">{{$total_cantidad}}</td>
                                    <td class="text-center">{{$total_ventas}}</td>
                                    <td class="text-center">{{$total_descuento}}</td>
                                    <td class="text-center">{{$total_costo}}</td>
                                    <td class="text-center">{{$total_ventas-$total_costo-$total_descuento}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <button class="btn btn-danger" wire:loading.attr="disabled" wire:target="descargar_pdf" wire:click='descargar_pdf'>Descargar en PDF</button>
                    </div>
                </div>
                @endif
            </div>
            </div>
        </div>
        @endif
    </div>
</div>
