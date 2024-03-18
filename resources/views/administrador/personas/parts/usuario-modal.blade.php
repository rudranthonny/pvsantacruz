<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#modalusuario">
    Modal Usuario
</button>

<!-- Modal -->
<div class="modal fade" id="modalusuario" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalUsuarioLabel">{{ $titlemodal }} Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="cerrar_modal_usuario_x"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="guardar" id="formularioUsuario">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-user"></i> <span class="text-danger">*</span></div>
                                <input type="text" class="form-control" id="usuariosform_username" placeholder="Escribir Usuario" wire:model.live="usuariosform.username">
                            </div>
                            @error('usuariosform.username')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-address-card"></i> <span class="text-danger">*</span></div>
                                <input type="text" class="form-control" id="usuariosform.name" placeholder="Escribir Nombre" wire:model="usuariosform.name">
                            </div>
                            @error('usuariosform.name')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-address-card"></i></div>
                                <input type="text" class="form-control" id="usuariosform.lastname" placeholder="Escribir Apellidos" wire:model="usuariosform.lastname">
                            </div>
                            @error('usuariosform.lastname')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6">
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-phone-alt"></i></div>
                                <input type="text" class="form-control" id="usuariosform.telefono" placeholder="Escribir Telefono" wire:model="usuariosform.telefono">
                            </div>
                            @error('usuariosform.telefono')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                <input type="text" class="form-control" id="usuariosform.email" placeholder="Escribir Email" wire:model="usuariosform.email">
                            </div>
                            @error('usuariosform.email')
                                <span class="error" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="pais" class="form-label">Imagen del Usuario</label>
                            <input type="file" class="form-control" id="imagen-{{$iteration}}" placeholder="Ingrese Imagen de la Usuario" wire:model.live="imagen_perfil">
                        </div>
                    </div>
                    @if (isset($usuariosform->user->id))
                    @if ($usuariosform->user->id)
                    <div class="row mb-3">
                        <div class="col-12 fs-5">
                            <center><b>Almacenes asignados</b></center>
                        </div>
                        <div class="col-12">
                            <select class="form-select" wire:model.live='salmacen'>
                                <option>Elegir</option>
                                <option value="todos">Todos</option>
                                @foreach ($almacenes as $almacen)
                                <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th>Almacen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuariosform->user->almacensuser as $almuser)
                                    <tr>
                                        <td class="text-center">{{$almuser->almacen->nombre}}</td>
                                        <td class="text-center"><button class="btn btn-danger" wire:target="eliminar_asignacion_almacen({{$almuser->id}})" wire:loading.attr="disabled" wire:click='eliminar_asignacion_almacen({{$almuser->id}})'><i class="fas fa-trash"></i></button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formularioUsuario" class="btn btn-primary">{{ $titlemodal }} Usuario</button>
            </div>
        </div>
    </div>
</div>
