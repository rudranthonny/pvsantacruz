<div >
    <div class="row">
        <div class="col-5">
            <div class="card text-center">
                <div class="card-header">
                    <div class="col-12" style="text-align: right;">
                  <img src="{{asset('imagenes/logo.png')}}" alt="" width="64px;">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 my-1">
                            <div class="input-group">
                                <input type="text" class="form-control" id="usuariosform_username" placeholder="Escribir Usuario" wire:model.live="usuariosform.username">
                                <div class="input-group-text"><i class="bi bi-person-add"></i> <span class="text-danger">*</span></div>
                            </div>
                        </div>
                        <div class="col-12 my-1">
                            <select class="form-select" id="compra_almacen" wire:model.live="">
                                <option value="">Elegir</option>
                                <option value="">Almacen 1</option>
                                <option value="">Almacen 2</option>
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
                                    <tr>
                                        <td>
                                            7702191163535<br>
                                            <span class="badge text-bg-success">3D EN POLVO BICARBONATO EUCALIPTO X1KG</span> <i style="color:green;" class="bi bi-pencil-square"></i>
                                        </td>
                                        <td>S/ 5000.00</td>
                                        <td ><center><input type="number" class="form-control" style="width: 80px;" name="" id=""></center></td>
                                        <td>S/ 5000.00</td>
                                        <td><i style="color:red;font-size: 24px;" class="bi bi-x-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            7702191163535<br>
                                            <span class="badge text-bg-success">3D EN POLVO BICARBONATO EUCALIPTO X1KG</span> <i style="color:green;" class="bi bi-pencil-square"></i>
                                        </td>
                                        <td>S/ 5000.00</td>
                                        <td ><center><input type="number" class="form-control" style="width: 80px;" name="" id=""></center></td>
                                        <td>S/ 5000.00</td>
                                        <td><i style="color:red;font-size: 24px;" class="bi bi-x-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            7702191163535<br>
                                            <span class="badge text-bg-success">3D EN POLVO BICARBONATO EUCALIPTO X1KG</span> <i style="color:green;" class="bi bi-pencil-square"></i>
                                        </td>
                                        <td>S/ 5000.00</td>
                                        <td ><center><input type="number" class="form-control" style="width: 80px;" name="" id=""></center></td>
                                        <td>S/ 5000.00</td>
                                        <td><i style="color:red;font-size: 24px;" class="bi bi-x-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            7702191163535<br>
                                            <span class="badge text-bg-success">3D EN POLVO BICARBONATO EUCALIPTO X1KG</span> <i style="color:green;" class="bi bi-pencil-square"></i>
                                        </td>
                                        <td>S/ 5000.00</td>
                                        <td ><center><input type="number" class="form-control" style="width: 80px;" name="" id=""></center></td>
                                        <td>S/ 5000.00</td>
                                        <td><i style="color:red;font-size: 24px;" class="bi bi-x-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            7702191163535<br>
                                            <span class="badge text-bg-success">3D EN POLVO BICARBONATO EUCALIPTO X1KG</span> <i style="color:green;" class="bi bi-pencil-square"></i>
                                        </td>
                                        <td>S/ 5000.00</td>
                                        <td ><center><input type="number" class="form-control" style="width: 80px;" name="" id=""></center></td>
                                        <td>S/ 5000.00</td>
                                        <td><i style="color:red;font-size: 24px;" class="bi bi-x-circle"></i></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            7702191163535<br>
                                            <span class="badge text-bg-success">3D EN POLVO BICARBONATO EUCALIPTO X1KG</span> <i style="color:green;" class="bi bi-pencil-square"></i>
                                        </td>
                                        <td>S/ 5000.00</td>
                                        <td ><center><input type="number" class="form-control" style="width: 80px;" name="" id=""></center></td>
                                        <td>S/ 5000.00</td>
                                        <td><i style="color:red;font-size: 24px;" class="bi bi-x-circle"></i></td>
                                    </tr>

                                    <tr>
                                        <td colspan="5">
                                            Datos no disponibles
                                        </td>
                                    </tr>
                                    <tr style="background-color: #7ec8ca">
                                        <td colspan="5">
                                            <b>Total por Pagar : S/ 5000.00</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 my-1">
                            <div class="row">
                                <div class="col-sm-4 col-12">
                                    <label for="impuesto" class="form-label"><b>Impuesto</b></label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="bi bi-percent"></i></div>
                                        <input type="text" class="form-control" id="impuesto" placeholder="0" wire:model.live="">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <label for="descuento" class="form-label"><b>Descuento</b></label>
                                    <div class="input-group">
                                        <div class="input-group-text">S/</div>
                                        <input type="text" class="form-control" id="descuento" placeholder="0" wire:model.live="">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <label for="envio" class="form-label"><b>Envió</b></label>
                                    <div class="input-group">
                                        <div class="input-group-text">S/ </div>
                                        <input type="text" class="form-control" id="envio" placeholder="0" wire:model.live="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12 col-sm-6">
                            <button class="btn btn-success btn-lg">Reiniciar</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <button class="btn btn-danger btn-lg">Pagar Ahora</button>
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
                            <label for=""><b>Categoria</b></label>
                            <select class="form-select" id="compra_almacen" wire:model.live="">
                                <option value="">Todos</option>
                                <option value="">Almacen 1</option>
                                <option value="">Almacen 2</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 my-1">
                            <label for=""><b>Marcas</b></label>
                            <select class="form-select" id="compra_almacen" wire:model.live="">
                                <option value="">Todos</option>
                                <option value="">Almacen 1</option>
                                <option value="">Almacen 2</option>
                            </select>
                        </div>
                        <div class="col-12 my-2">
                            <label class="visually-hidden" for="buscar_proveedor">Buscar Producto</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-search"></i></div>
                                <input type="text" class="form-control" id="buscar_proveedor" placeholder="Buscar Proveedor" wire:model.live="search">
                            </div>
                        </div>
                    </div>
                    <!--lista de producto-->
                    <div class="row my-2">
                        <div class="col-2">
                            <div class="card">
                                <img src="{{ asset('imagenes/no-image.png') }}" style="object-fit: cover;" height="80px;" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 m-0 p-0" style="padding: 0px;">
                                            3D EN POLVO BICA<br>
                                            7702191163535<br>
                                            <span class="badge text-bg-warning">s/ 5000.00</span>
                                        </div>
                                    </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <img src="{{ asset('imagenes/no-image.png') }}" style="object-fit: cover;" height="80px;" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 m-0 p-0" style="padding: 0px;">
                                            3D EN POLVO BICA<br>
                                            7702191163535<br>
                                            <span class="badge text-bg-warning">s/ 5000.00</span>
                                        </div>
                                    </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <img src="{{ asset('imagenes/no-image.png') }}" style="object-fit: cover;" height="80px;" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 m-0 p-0" style="padding: 0px;">
                                            3D EN POLVO BICA<br>
                                            7702191163535<br>
                                            <span class="badge text-bg-warning">s/ 5000.00</span>
                                        </div>
                                    </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <img src="{{ asset('imagenes/no-image.png') }}" style="object-fit: cover;" height="80px;" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 m-0 p-0" style="padding: 0px;">
                                            3D EN POLVO BICA<br>
                                            7702191163535<br>
                                            <span class="badge text-bg-warning">s/ 5000.00</span>
                                        </div>
                                    </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <img src="{{ asset('imagenes/no-image.png') }}" style="object-fit: cover;" height="80px;" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 m-0 p-0" style="padding: 0px;">
                                            3D EN POLVO BICA<br>
                                            7702191163535<br>
                                            <span class="badge text-bg-warning">s/ 5000.00</span>
                                        </div>
                                    </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <img src="{{ asset('imagenes/no-image.png') }}" style="object-fit: cover;" height="80px;" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 m-0 p-0" style="padding: 0px;">
                                            3D EN POLVO BICA<br>
                                            7702191163535<br>
                                            <span class="badge text-bg-warning">s/ 5000.00</span>
                                        </div>
                                    </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <!--paginacion-->
                    <div class="row my-2">
                    </div>
                </div>
              </div>
        </div>
    </div>
</div>
