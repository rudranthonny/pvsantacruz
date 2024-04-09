<div>
    <div class="row">
        <div class="col-sm-6 col-12 mb-3">
            <label for="">Elegir Almacen</label>
            <select name="almacen" id="" class="form-select" wire:model='salmacen'>
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
</div>
