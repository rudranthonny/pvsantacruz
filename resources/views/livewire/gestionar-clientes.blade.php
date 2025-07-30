<div class="container">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!--titulo-->
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Gestión de Clientes</span> Personas | Gestión de Clientes
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
                        <div class="d-flex justify-content-between align-items-center">
                            <span><b>Gestión de Clientes</b></span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalCliente" wire:click='modal'><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="visually-hidden" for="buscar_clientes">Buscar Cliente</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    <input type="text" class="form-control" id="buscar_clientes"
                                        placeholder="Buscar Cliente" wire:model.live='search'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Nit</th>
                                            <th>Teléfono</th>
                                            <th>Email</th>
                                            <th>Deuda</th>
                                            <th>Gratuito</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($clientes as $cliente)
                                            <tr class="text-center">
                                                <td>{{ $cliente->id }}</td>
                                                <td>{{ $cliente->name }}</td>
                                                <td>{{ $cliente->nit }}</td>
                                                <td>{{ $cliente->telefono }}</td>
                                                <td>{{ $cliente->email }}</td>
                                                <td>
                                                    @if ($cliente->deuda_total > 0)
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalPagoDeuda"
                                                    wire:click="modal_pagar_deuda('{{ $cliente->id }}')">{{ $configuracion->moneda->simbolo."".$cliente->deuda_total }}</a>
                                                    @else
                                                    {{ $configuracion->moneda->simbolo."0" }}
                                                    @endif

                                                </td>
                                                <td>{{ $cliente->gratuito }}</td>
                                                <td>
                                                    <a href="{{route('admin.pacientes.reservas',$cliente->id)}}" target="_blank" class="btn btn-success" id="consultar_reservas_{{$cliente->id}}" ><i class="fas fa-search"></i></a>
                                                    <button class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#modalReporteDeudas"
                                                    wire:click="modal_reporte_deudas('{{ $cliente->id }}')"><i class="fas fa-list"></i></button>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#modalCliente"
                                                        wire:click="modal('{{ $cliente->id }}')"><i
                                                            class="fas fa-edit"></i></button>
                                                    
                                                    <button class="btn btn-secondary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalHistorialReservas"
                                                        wire:click="abrir_historial_reservas({{ $cliente->id }})">
                                                        <i class="fas fa-history"></i>
                                                    </button>
                                                    <button class="btn {{ $cliente->estado ? 'btn-success' : 'btn-danger' }}"
                                                        title="{{ $cliente->estado ? 'Desactivar cliente' : 'Activar cliente' }}"
                                                        wire:click="estado_cliente({{ $cliente->id }})"
                                                        wire:confirm="{{ $cliente->estado 
                                                            ? '¿Estás seguro de suspender al cliente? Se perderán las reservas para acumular horas gratuitas.' 
                                                            : '¿Estás seguro de activar al cliente?' }}">
                                                        <i class="fas {{ $cliente->estado ? 'fa-user-check' : 'fa-user-slash' }}"></i>
                                                    </button>
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
                                {{ $clientes->links() }}
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
                    @include('administrador.personas.parts.cliente-modal')
                    @include('administrador.personas.parts.cliente-pagar-deuda')
                    @include('administrador.personas.parts.cliente-reporte-deudas')
                </div>
            </div>
        </div>
    </div>
    @include('administrador.cliente.modal_reservas_cliente')
</div>

