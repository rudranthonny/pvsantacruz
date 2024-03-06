<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!--titulo-->
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Unidades</span> Productos | Unidades
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
                            <span><b>Listado de Unidades</b></span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalUnidad" wire:click='modal'><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="visually-hidden" for="buscar_unidades">Username</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    <input type="text" class="form-control" id="buscar_unidades"
                                        placeholder="Buscar Unidades" wire:model.live='search'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>Nombre</th>
                                            <th>Nombre Corto</th>
                                            <th>Unidad Base</th>
                                            <th>Operador</th>
                                            <th>Valor de Operación</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($unidades as $unidad)
                                            <tr class="text-center">
                                                <td>{{ $unidad->name }}</td>
                                                <td>{{ $unidad->name_cor }}</td>
                                                <td>{{ $unidad->unidadb }}</td>
                                                <td>{{ $unidad->operador }}</td>
                                                <td>{{ $unidad->valor }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#modalUnidad"
                                                        wire:click="modal('{{ $unidad->id }}')"><i
                                                            class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger"
                                                        wire:click="eliminar({{ $unidad->id }})"
                                                        id="eliminar-unidad-{{ $unidad->id }}"
                                                        wire:confirm="Estas seguro de Eliminar esta Unidad?">
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
                                {{ $unidades->links() }}
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
                    @include('administrador.productos.parts.unidad-modal')
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('cerrar_modal_unidad', reservacion => {
            ventana = document.getElementById('cerrar_modal_unidad_x').click();
        });
    </script>
@endscript
