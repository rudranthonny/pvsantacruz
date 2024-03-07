<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalCompra">
    Modal Compras
</button>

<!-- Modal -->
<div class="modal fade" id="modalCompra" tabindex="-1" aria-labelledby="modalCompraLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-12 fs-6">
                        <span class="fs-3 fw-bold">{{ $titlemodal }} Compras</span> Compras | {{ $titlemodal }} Compras
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_compra_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioCompra">
                    <!--fecha - proveedor - almacen-->
                    <div class="row">
                        <div class="col-sm-4 col-12">
                            <label for="compra_fecha" class="form-label">Fecha <span class='text-red'>(*)</span></label>
                            <input type="date" id="compra_fecha" class="form-control" wire:model=''>
                        </div>
                        <div class="col-sm-4 col-12">
                            <label for="compra_proveedor" class="form-label">Proveedor <span class='text-red'>(*)</span></label>
                            <select class="form-select" id="compra_proveedor">
                                <option value="">Elegir</option>
                                @foreach ($proveedors as $prove)
                                <option value="{{$prove->id}}">{{$prove->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4 col-12">
                            <label for="compra_almacen" class="form-label">Almacen <span class='text-red'>(*)</span></label>
                            <select class="form-select" id="compra_proveedor">
                                <option value="">Elegir</option>
                                @foreach ($almacens as $alme)
                                <option value="{{$alme->id}}">{{$alme->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--buscar modal-->
                    <div class="row my-4">
                        <div class="col-12">
                            <label class="visually-hidden" for="buscar_compras">Buscar Compra</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-search"></i></div>
                                <input type="text" class="form-control" id="buscar_compras"
                                    placeholder="Escanear / Buscar producto por nombre de código" wire:model.live=''>
                            </div>
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
                                        <th>nombre del producto</th>
                                        <th>Costo unitario neto</th>
                                        <th>Stock actual</th>
                                        <th>Cantidad</th>
                                        <th>Descuento</th>
                                        <th>Impuesto</th>
                                        <th>Total parcial</th>
                                   </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td colspan="8">Datos no disponibles</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="offset-md-9 col-md-3 mt-4">
                            <table class="table table-striped table-sm">
                                <tbody>
                                    <tr>
                                        <td class="bold">Impuesto de orden</td>
                                        <td><span>$ 0.00 (0.00 %)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Descuento</td>
                                        <td>$ 0.00</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Envío</td>
                                        <td>$ 0.00</td>
                                    </tr>
                                    <tr>
                                        <td><span class="font-weight-bold">Total</span></td>
                                        <td><span class="font-weight-bold">$ 0.00</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label class="form-label" for="buscar_compras">Impuesto de orden</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="buscar_compras" placeholder="0" wire:model.live=''>
                                <div class="input-group-text"><i class="fas fa-percentage"></i></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label" for="buscar_compras">Descuento</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="0" id="buscar_compras" wire:model.live=''>
                                <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label" for="buscar_compras">Envío</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="0" id="buscar_compras" wire:model.live=''>
                                <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-12">
                            <label for="compra_proveedor" class="form-label">Estado <span class='text-red'>(*)</span></label>
                            <select class="form-select" id="compra_proveedor">
                                <option value="">Elegir</option>
                                <option value="1">Recibido</option>
                                <option value="2">pendiente</option>
                                <option value="3">orden</option>
                            </select>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-12">
                            <label for="compra_nota" class="form-label">Nota</label>
                            <textarea class="form-control" id="compra_nota" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-12">
                            <button type="submit" form="formularioCompra" class="btn btn-primary">{{ $titlemodal }} Compra</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
