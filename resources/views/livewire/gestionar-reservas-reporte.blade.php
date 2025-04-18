<div class="container-fluid pb-5">
    <h3 class="mb-4 text-center">Reporte de Reservas por Canchas</h3>

    <!-- Filtros -->
    <div class="row g-3 align-items-end mb-4">
        <div class="col-sm-6 col-md-3">
            <label>Desde</label>
            <input type="date" class="form-control" wire:model.live="fecha_inicio">
        </div>
        <div class="col-sm-6 col-md-3">
            <label>Hasta</label>
            <input type="date" class="form-control" wire:model.live="fecha_fin">
        </div>
        <div class="col-sm-12 col-md-3">
            <button class="btn btn-danger w-100" wire:loading.attr='disabled' wire:target='descargar_reporte_reservas_pdf' wire:click="descargar_reporte_reservas_pdf">
                <i class="fas fa-file-pdf"></i> Descargar PDF
            </button>
        </div>
        <div class="col-sm-12 col-md-3">
            <button class="btn btn-success w-100"
                wire:click="descargar_reporte_reservas_excel"
                wire:loading.attr="disabled"
                wire:target="descargar_reporte_reservas_excel">
                <i class="fas fa-file-excel"></i> Descargar Excel
            </button>
        </div>
    </div>

    <!-- Ingresos Totales -->
    <div class="row mb-4">
        <div class="col-md-4 col-sm-12">
            <div class="card bg-info text-white shadow">
                <div class="card-body text-center">
                    <h5>Ingresos Totales</h5>
                    <h3 class="fw-bold">S/ {{ number_format($this->ingresosTotales, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Estado de Reservas por Cancha -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="mb-2">Reservas por Cancha</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Cancha</th>
                            <th>Total</th>
                            <th>Utilizadas</th>
                            <th>Reservadas</th>
                            <th>Anulados Pendientes</th>
                            <th>Anuladas</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @foreach ($this->reservasPorCancha as $rc)
                            <tr>
                                <td>{{ $rc['cancha'] }}</td>
                                <td>{{ $rc['total'] }}</td>
                                <td>{{ $rc['utilizadas'] }}</td>
                                <td>{{ $rc['reservadas'] }}</td>
                                <td>{{ $rc['solicitudes'] }}</td>
                                <td>{{ $rc['anuladas'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Gratuitas por Cliente -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="mb-2">Partidas Gratuitas por Cliente</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Cliente</th>
                            <th>Horas Gratuitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->gratuitasPorCliente as $cliente)
                            <tr>
                                <td>{{ $cliente['cliente'] }}</td>
                                <td>{{ $cliente['gratuitas'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Detalle de Reservas -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="mb-2">Detalle de Reservas</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Ingreso</th>
                            <th>Salida</th>
                            <th>Cliente</th>
                            <th>Cancha</th>
                            <th>Horas</th>
                            <th>Subtotal</th>
                            <th>Estado</th>
                            <th>Gratuito</th>
                            <th>Anulación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->reservas as $index => $r)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->fingreso)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->fingreso)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->fsalida)->format('H:i') }}</td>
                                <td>{{ $r->cliente->name ?? '—' }}</td>
                                <td>{{ $r->cancha->name ?? '—' }}</td>
                                <td>{{ $r->horas }}</td>
                                <td>S/ {{ number_format($r->subtotal, 2) }}</td>
                                <td>
                                    @if ($r->estado == 'Utilizada')
                                        <span class="badge bg-primary">{{ $r->estado }}</span>
                                    @elseif ($r->estado == 'Reservado')
                                        <span class="badge bg-warning text-dark">{{ $r->estado }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $r->estado }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($r->gratuito)
                                        <span class="badge bg-success">Sí</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($r->motivo_anulacion)
                                        <span class="text-danger">{{ \Illuminate\Support\Str::limit($r->motivo_anulacion, 40) }}</span>
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>