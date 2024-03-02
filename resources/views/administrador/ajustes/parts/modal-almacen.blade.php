<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalAlmacen">
    Almacen modal
</button>

<!-- Modal -->
<div class="modal fade" id="modalAlmacen" tabindex="-1" aria-labelledby="modalAlmacenLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalAlmacenLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <caption class="caption-top">Lista de Almacenes</caption>
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Pais</th>
                            <th>Cuidad</th>
                            <th>Email</th>
                            <th>Codigo Postal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($almacenEdits as $almacenEdit)
                            <tr>
                                <td>{{ $almacenEdit->nombre }}</td>
                                <td>{{ $almacenEdit->telefono }}</td>
                                <td>{{ $almacenEdit->pais }}</td>
                                <td>{{ $almacenEdit->cuidad }}</td>
                                <td>{{ $almacenEdit->email }}</td>
                                <td>{{ $almacenEdit->codigo_postal }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td>Nombre</td>
                            <td>Telefono</td>
                            <td>Pais</td>
                            <td>Cuidad</td>
                            <td>Email</td>
                            <td>Codigo Postal</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
