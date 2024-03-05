<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!--titulo-->
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Monedas</span> Configuraciones | Monedas
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
                            <span><b>Listado de Monedas</b></span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalMoneda" wire:click='modal'><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="visually-hidden" for="buscar_moneda">Username</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    <input type="text" class="form-control" id="buscar_moneda"
                                        placeholder="Buscar Moneda" wire:model.live='search'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>Codigo Moneda</th>
                                            <th>Nombre Moneda</th>
                                            <th>Simbolo</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($monedas as $moneda)
                                            <tr class="text-center">
                                                <td>{{ $moneda->codigo_moneda }}</td>
                                                <td>{{ $moneda->nombre_moneda }}</td>
                                                <td>{{ $moneda->simbolo }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#modalMoneda"
                                                        wire:click="modal('{{ $moneda->id }}')"><i
                                                            class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger"
                                                        wire:click="eliminar({{ $moneda->id }})"
                                                        id="eliminar-moneda-{{ $moneda->id }}"
                                                        wire:confirm="Estas seguro de Eliminar esta Moneda">
                                                        <i class="fas fa-trash"></i>
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
                                {{ $monedas->links() }}
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
                    @include('administrador.ajustes.parts.moneda-modal')
                </div>
            </div>
        </div>
    </div>
</div>
