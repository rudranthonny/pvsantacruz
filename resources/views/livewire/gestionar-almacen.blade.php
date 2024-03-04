<div>
    <!--titulo-->
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Alamcenes </span> Configuraciones | Alamcenes
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
                            <span><b>Listado de Almacenes</b></span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalAlmacen" wire:click='modal'><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="visually-hidden" for="buscar_almacen">Almacen</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    <input type="text" class="form-control" id="buscar_almacen"
                                        placeholder="Buscar Almacen" wire:model.live='search'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <caption class="caption-top">Lista de Almacenes</caption>
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Telefono</th>
                                            <th>Pais</th>
                                            <th>ciudad</th>
                                            <th>Email</th>
                                            <th>Codigo Postal</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($almacens as $almacen)
                                            <tr>
                                                <td>{{ $almacen->nombre }}</td>
                                                <td>{{ $almacen->telefono }}</td>
                                                <td>{{ $almacen->pais }}</td>
                                                <td>{{ $almacen->ciudad }}</td>
                                                <td>{{ $almacen->email }}</td>
                                                <td>{{ $almacen->codigo_postal }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#modalAlmacen"
                                                        wire:click="modal('{{ $almacen->id }}')"><i
                                                            class="fas fa-edit"></i></button>
                                                            <button type="button" class="btn btn-danger"
                                                            wire:click="eliminar({{ $almacen->id }})"
                                                            id="eliminar-almacen-{{ $almacen->id }}"
                                                            wire:confirm="Estas seguro de Eliminar esta Almacen">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <td>Nombre</td>
                                            <td>Telefono</td>
                                            <td>Pais</td>
                                            <td>ciudad</td>
                                            <td>Email</td>
                                            <td>Codigo Postal</td>
                                            <td>Accion</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-9">
                                {{ $almacens->links() }}
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
                    @include('administrador.ajustes.parts.almacen-modal')
                </div>
            </div>
        </div>
    </div>
</div>
