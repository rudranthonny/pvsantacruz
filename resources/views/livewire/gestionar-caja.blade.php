<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!--titulo-->
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Lista de Cajas</span> Ventas | Lista de Cajas
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
                            <span><b>Listado de Cajas</b></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12 col-sm-3">
                                <label  for="buscar_compras">Buscar Cajero</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    <input type="text" class="form-control" id="buscar_venta"
                                        placeholder="Buscar Cajero" wire:model.live='search'>
                                </div>
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
                                            <th>#</th>
                                            <th>Fecha Apertura</th>
                                            <th>Fecha Cierre</th>
                                            <th>Cajero</th>
                                            <th>Monto</th>
                                            <th>Observación</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cajas as $key => $pcaja)
                                        <tr role="row" class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#tablecollapse-{{$pcaja->id}}" aria-expanded="false" aria-controls="tablecollapse-{{$pcaja->id}}">
                                            <td role="cell" class="text-center"  style="vertical-align: middle;">{{ $key+1 }}</td>
                                            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $pcaja->fecha_apertura }}</td>
                                            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $pcaja->fecha_cierre }}</td>
                                            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $pcaja->user->lastname." ".$pcaja->user->name}}</td>
                                            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $configuracion->moneda->simbolo.$pcaja->monto }}</td>
                                            <td role="cell" class="text-center" style="vertical-align: middle;">{{ $pcaja->observacion }}</td>
                                            <td role="cell" class="text-center" style="vertical-align: middle;">
                                                <button class="btn btn-danger" wire:loading.attr='disabled' id="descargar_reporte_caja-{{$pcaja->id}}" wire:target='descargar_reporte_caja({{$pcaja->id}})' wire:click='descargar_reporte_caja({{$pcaja->id}})'><i class="fas fa-download"></i></button>
                                            </td>
                                        </tr>
                                        <tr role="row">
                                            <td role="cell" colspan="9" class="p-0">
                                                <div id="tablecollapse-{{$pcaja->id}}" class="accordion-collapse collapse" aria-labelledby="heading-1" data-bs-parent="#accordionExample" style="">
                                                    <div>
                                                        <table role="table" width="100%" class="table table-primary">
                                                            <thead role="rowgroup">
                                                                <tr>
                                                                    <th colspan="7"><center>DETALLE DE CAJA</center></th>
                                                                </tr>
                                                                <tr role="row">
                                                                    <th class="text-center" role="columnheader">Tipo de Movimiento</th>
                                                                    <th class="text-center" role="columnheader">Cliente</th>
                                                                    <th class="text-center" role="columnheader">Signo</th>
                                                                    <th class="text-center" role="columnheader">Ingreso</th>
                                                                    <th class="text-center" role="columnheader">Egreso</th>
                                                                    <th class="text-center" role="columnheader">Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody role="rowgroup">
                                                                @foreach ($pcaja->mcajas as $mcaja)
                                                                <tr role="row">
                                                                    <td class="text-center">{{ $mcaja->tmovmientocaja->name }}</td>
                                                                    <td class="text-center">
                                                                        @if ($mcaja->tmovimiento_caja_id == 3)
                                                                            {{$mcaja->m_cajable->cliente_name}}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">{{ $mcaja->signo }}</td>
                                                                    <td class="text-center">
                                                                        @if ($mcaja->signo == '+'){{$configuracion->moneda->simbolo . $mcaja->monto}} @endif
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @if ($mcaja->signo == '-') {{$configuracion->moneda->simbolo . $mcaja->monto}} @endif
                                                                    </td>
                                                                    <td class="text-center">
                                                                            @if ($mcaja->tmovimiento_caja_id == 3)
                                                                                <button class="btn btn-success" wire:loading.attr='disabled' id="venta_descargar-{{$mcaja->m_cajable_id}}" wire:target='descargar_venta_pdf({{$mcaja->m_cajable_id}})' wire:click='descargar_venta_pdf({{$mcaja->m_cajable_id}})'><i class="fas fa-download"></i></button>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-9">
                                {{ $cajas->links() }}
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
</div>
