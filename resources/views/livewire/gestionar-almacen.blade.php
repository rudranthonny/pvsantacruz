<div>
    <!--titulo-->
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3">Gestionar Almacenes</span>
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
                            <span>Almacenes</span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalAlmacen">Añadir</button>
                        </div>
                    </div>
                    <div class="card-body">
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
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalAlmacen"
                                                wire:click="editar('{{ $almacen->id }}')">editar</button>
                                            <button class="btn btn-danger">eliminar</button>
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
                    @include('administrador.ajustes.parts.almacen-modal')
                </div>
            </div>
        </div>
    </div>
</div>
