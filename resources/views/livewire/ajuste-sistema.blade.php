<div>
    <!--titulo-->
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3">Ajuste del Sistema</span> Configuraciones | Ajuste del Sistema
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
    <!--cuerpo-->
    <div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Ajustes del sistema
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="moneda_predeterminada" class="form-label">Moneda Predeterminada</label>
                                <select class="form-select" id="moneda_predeterminada" wire:model='ajustesistemaform.moneda_predeterminada'>
                                    <option value="1">Peso</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="email_predeterminado" class="form-label">Email Predeterminado <span style="color:red;">*</span></label>
                                <input type="email" class="form-control" id="email_predeterminado" placeholder="Email Predeterminado" wire:model='ajustesistemaform.email_predeterminado'>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="logo" class="form-label">Cambiar logo</label>
                                <input class="form-control" type="file" id="logo" wire:model='imagen_logo'>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="nombre_empresa" class="form-label">Nombre de Empresa <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="nombre_empresa" wire:model='ajustesistemaform.name' placeholder="Nombre de empresa">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="telefono_empresa" class="form-label">Telefono de la Empresa <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="telefono_empresa" wire:model='ajustesistemaform.telefono_empresa' placeholder="Telefono de la Empresa">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="desarrollador" class="form-label">Desarrollado por <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="desarrollador" wire:model='ajustesistemaform.desarrollador' placeholder="Desarrollado por">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="pie_de_pagina" class="form-label">Pie de página <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="pie_de_pagina" wire:model='ajustesistemaform.pie_pagina'  placeholder="Pie de Pagina">
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="almacen_predeterminada" class="form-label">Almacen Predeterminada</label>
                                <select class="form-select" id="almacen_predeterminada" wire:model='ajustesistemaform.almacen_id'>
                                    <option value="1">San Isidreo</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="direccion" class="form-label">Dirección <span style="color:red;">*</span></label>
                                <textarea rows="2" class="form-control" id="direccion" wire:model='ajustesistemaform.direccion'></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <input type="checkbox" id="pagina_factura" wire:model='ajustesistemaform.pagina_factura'>
                                <label class="form-check-label" for="pagina_factura">Pie de página de la Factura</label>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <label for="pie_pagina_factura" class="form-label">Pie de página de la Factura <span style="color:red;">*</span></label>
                                <textarea rows="2" class="form-control" id="pie_pagina_factura" wire:model='ajustesistemaform.pie_pagina_factura'></textarea>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <input type="checkbox" id="cotizacion_stock" wire:model='ajustesistemaform.cotizacion_stock'>
                                <label class="form-check-label" for="cotizacion_stock">Crear Cotización con stock</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <button class="btn btn-primary"><i class="fas fa-check-circle"></i> Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
