<div>
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Imprimir código de barras</span> Productos | Imprimir código de barras
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <label for="seleccionar_almacen">Almacén <span>*</span></label>
                <select id="seleccionar_almacen" class="form-select">
                    <option value="">Elegir</option>
                    @foreach ($almacenes as $almacen)
                    <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-12">
                <label class="visually-hidden" for="buscar_producto">Nombre del Producto</label>
                <div class="input-group">
                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                    <input type="text" class="form-control" id="buscar_producto"
                        placeholder="Buscar Producto" wire:model.live='search'>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre del producto</th>
                            <th>Código del producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        <tr>
                            <td colspan="3">Datos no disponibles</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="seleccionar_almacen">Tamaño de Papel</label>
                <select id="seleccionar_almacen" class="form-select">
                    <option value="">Tamaño del Papel</option>
                    <option value="40 per sheet (a4) (1.799 * 1.003)">40 per sheet (a4) (1.799 * 1.003)</option>
                    <option value="30 per sheet (2.625 * 1)">30 per sheet (2.625 * 1)</option>
                    <option value="24 per sheet (a4) (2.48 * 1.334)">24 per sheet (a4) (2.48 * 1.334)</option>
                    <option value="20 per sheet (4 * 1)">20 per sheet (4 * 1)</option>
                    <option value="18 per sheet (a4) (2.5 * 1.835)">18 per sheet (a4) (2.5 * 1.835)</option>
                    <option value="14 per sheet (4 * 1.33)">14 per sheet (4 * 1.33)</option>
                    <option value="12 per sheet (a4) (2.5 * 2.834)">12 per sheet (a4) (2.5 * 2.834)</option>
                    <option value="10 per sheet (4 * 2)">10 per sheet (4 * 2)</option>
                </select>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-12">
                <button class="btn btn-primary"><i class="fas fa-edit"></i> Actualizar</button>
                <button class="btn btn-danger"><i class="fas fa-sync"></i> Reiniciar</button>
                <button class="btn btn-secondary"><i class="fas fa-print"></i> Impresión</button>
            </div>
        </div>
    </div>
</div>
