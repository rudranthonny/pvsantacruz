<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!--titulo-->
    <div>
        <div class="row">
            <div class="col-12 fs-6">
                <span class="fs-3 fw-bold">Personas</span> Personas | Usuarios
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
                            <span><b>Listado de Usuarios</b></span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalusuario" wire:click='modal'><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-12 col-sm-8">
                                <label class="visually-hidden" for="buscar_usuario">Buscar Usuario</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    <input type="text" class="form-control" id="buscar_usuario"
                                        placeholder="Buscar usuario" wire:model.live='search'>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <button class="btn btn-outline-success"><i class="fas fa-download"></i> Excel</button>
                                <button class="btn btn-outline-danger"><i class="fas fa-download"></i> PDF</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr class="text-center">
                                            <th>Imagen</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Usuario</th>
                                            <th>Email</th>
                                            <th>Telefono</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($usuarios as $usuario)
                                            <tr class="text-center">
                                                <td style="vertical-align:middle;" >
                                                    @if ($usuario->profile_photo_path)
                                                    <img src="{{asset($usuario->profile_photo_path)}}" class="img-thumbnail" alt="" width="64px;">
                                                    @else
                                                    <img src="{{asset('imagenes/no-image.png')}}" class="img-thumbnail" alt="" width="64px;">
                                                    @endif
                                                </td>
                                                <td style="vertical-align:middle;">{{ $usuario->name }}</td>
                                                <td style="vertical-align:middle;">{{ $usuario->lastname }}</td>
                                                <td style="vertical-align:middle;">{{ $usuario->username }}</td>
                                                <td style="vertical-align:middle;">{{ $usuario->telefono }}</td>
                                                <td style="vertical-align:middle;">{{ $usuario->email }}</td>
                                                <td style="vertical-align:middle;">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="campo-obligatio-1" @if ($usuario->suspended == 1) checked @endif wire:target="cambiar_estado_suspension({{$usuario->id}})" wire:loading.attr="disabled" wire:click="cambiar_estado_suspension({{$usuario}})">
                                                    </div>
                                                </td>
                                                <td style="vertical-align:middle;" >
                                                    <button type="button" class="btn btn-outline-success"
                                                        data-bs-toggle="modal" data-bs-target="#modalusuario"
                                                        wire:click="modal('{{ $usuario->id }}')"><i
                                                            class="fas fa-edit"></i>
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
                                {{ $usuarios->links() }}
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
                    @include('administrador.personas.parts.usuario-modal')
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('cerrar_modal_user', reservacion => {
            ventana = document.getElementById('cerrar_modal_usuario_x').click();
        });
    </script>
@endscript
