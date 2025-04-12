<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalDevolucion">
    Modal Compras
</button>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalDevolucion" tabindex="-1" aria-labelledby="modalDevolucionLabel" aria-hidden="true" >
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-12 fs-6">
                        <span class="fs-3 fw-bold"> Devolucion</span> Venta | Devolucion Venta
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_devolucion_x"></button>
            </div>
            <div class="modal-body">
                    <!--fecha - proveedor - almacen-->
                    <div class="row">
                        <div class="col-sm-4 col-12">
                            <label for="compra_fecha" class="form-label">Fecha <span class='text-red'>(*)</span></label>
                            <input type="date" id="compra_fecha" class="form-control" wire:model.live='devolucionform.fecha'>
                            @error('devolucionform.fecha')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                    </div>
                    <!--buscar modal-->
                    <div class="row my-4">
                        <div class="col-12">
                            <input type="hidden" id="buscar_producto_oculto" wire:model.live='buscar_producto_oculto'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            encargar artículos <span class="text-red">(*)</span>
                        </div>
                        <div class="col-12">
                            <table class="table table-striped">
                                <thead class="table-secondary">
                                   <tr class="text-center">
                                        <th>#</th>
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <th>Tipo</th>
                                        <th>-</th>
                                   </tr>
                                </thead>
                                @if (count($devolucionform->detalles_devolucion) == 0)
                                <tbody>
                                    <tr class="text-center">
                                        <td colspan="10">Datos no disponibles</td>
                                    </tr>
                                </tbody>
                                @else
                                <tbody>
                                        @php $contador = 0; @endphp
                                        @foreach ($devolucionform->detalles_devolucion as $key=> $detcom)
                                            @php $contador++; @endphp
                                            <tr class="text-center">
                                                <td>{{$contador}}</td>
                                                <td>{{$devolucionform->detalles_devolucion[$key]['producto_codigo']}}</td>
                                                <td>{{$devolucionform->detalles_devolucion[$key]['producto_nombre']}}</td>
                                                <td>{{$devolucionform->detalles_devolucion[$key]['producto_precio']}}</td>
                                                @php $valor_cantidad = 'devolucionform.detalles_devolucion.'.$key.'.producto_cantidad';@endphp
                                                <td><input type="number" id="input_cantidad_{{$key}}" class="form-control"  min="1" wire:model.live='{{$valor_cantidad}}' ></td>
                                                <td>{{number_format($devolucionform->detalles_devolucion[$key]['producto_importe'],2)}}</td>
                                                <td>{{$devolucionform->detalles_devolucion[$key]['producto_tipo']}}</td>
                                                <td>
                                                    <button class="btn btn-outline-danger" id="eliminar_item_devolucion_{{$key}}" wire:click='eliminar_item_devolucion("{{$key}}")'><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                        <div>
                            @error('devolucionform.detalles_devolucion')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3 mt-4">
                            <table class="table table-striped table-sm">
                                <tbody>
                                    <tr>
                                        <td class="bold">Total sin Impuesto</td>
                                        <td><span>{{$devolucionform->total_sin_impuesto}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Impuesto</td>
                                        <td><span>{{number_format($devolucionform->impuesto_monto,2)}} ({{number_format($devolucionform->impuesto_porcentaje,2)}} %)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Descuento</td>
                                        <td>
                                            @if ($devolucionform->descuento)
                                            {{number_format($devolucionform->descuento,2)}}
                                            @else
                                                0.00
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Envío</td>
                                        <td>
                                            @if ($devolucionform->envio)
                                                {{number_format($devolucionform->envio,2)}}
                                            @else
                                                0.00
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="font-weight-bold">Total</span></td>
                                        <td><span class="font-weight-bold">{{number_format($devolucionform->total_pagar,2)}}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="form-label" for="buscar_compras">Impuesto </label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="impuesto_porcentaje" placeholder="0" wire:model.live.debounce.500ms='devolucionform.impuesto_porcentaje'>
                                <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label" for="buscar_compras">Descuento</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="0" min="1" id="buscar_compras" wire:model.live.debounce.500ms='devolucionform.descuento'>
                                <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label" for="buscar_compras">Envío</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="0" min="1" id="buscar_compras" wire:model.live.debounce.500ms='devolucionform.envio'>
                                <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-12">
                            <label for="devolucionform_nota" class="form-label">Nota</label>
                            <textarea class="form-control" id="devolucionform_nota" rows="3" wire:model.live='devolucionform.nota_devolucion'></textarea>
                        </div>
                    </div>
                    @if ($devolucionform->total_sin_impuesto > 0)
                    <div class="row my-4">
                        <div class="col-12">
                            <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="save_devolucion" wire:click='save_devolucion'>Crear Devolución</button>
                        </div>
                    </div>
                    @endif
            </div>
        </div>
    </div>
    @script
    <script>
        $wire.on('cerrar_modal_devolucion', reservacion => {
            ventana = document.getElementById('cerrar_modal_devolucion_x').click();
        });
    </script>
    @endscript
</div>



