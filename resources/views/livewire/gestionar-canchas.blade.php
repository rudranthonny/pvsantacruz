<div class="container">
    <div class="row">
        <div class="col-12 my-3">
            <button class="btn btn-success w-100"
                    wire:click="modal_cancha"
                    data-bs-toggle="modal"
                    data-bs-target="#modal_crear_actualizar_cancha">
                <i class="fas fa-plus-circle"></i> Crear Cancha
            </button>
        </div>

        @foreach ($canchas as $cancha)
            <div class="col-md-6 mb-4">
                <div class="card shadow h-100 text-center position-relative">
                    <!-- Badge en esquina superior derecha -->
                    <span 
                    class="position-absolute top-0 end-0 badge rounded-pill bg-danger m-2"
                    wire:click='seleccionar_cancha({{$cancha->id}})'
                    data-bs-toggle="modal" 
                    data-bs-target="#modal_solicitudes"
                    >
                       Solicitudes Anulación {{ $cancha->reservas_solicitudes->count() }}
                    </span>

                    <div class="card-body">
                        <img src="{{ asset('imagenes/cancha.png') }}" width="125px" height="125px">
                        <h5 class="card-title mt-2"><b>{{ $cancha->name }}</b></h5>
                        <p class="text-muted">Q.{{ $cancha->costo }}</p>

                        <div class="row mt-3">
                            <div class="col-12 my-1">
                                <button class="btn btn-info w-100" wire:loading.attr='disabled' wire:target='consultar_reserva' wire:click="consultar_reserva({{ $cancha->id }})">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="col-12 my-1">
                                <button class="btn btn-warning w-100"
                                        wire:click="modal_cancha({{ $cancha->id }})"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal_crear_actualizar_cancha">
                                    Editar
                                </button>
                            </div>
                            <div class="col-12 my-1">
                                <button class="btn btn-danger w-100"
                                        wire:click="eliminar_cancha({{ $cancha->id }})"
                                        onclick="confirm('¿Estás seguro de eliminar esta cancha?') || event.stopImmediatePropagation()">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


        <div class="d-flex justify-content-center mt-3">
            {{ $canchas->links() }}
        </div>
    </div>

    @script
    <script>
        $wire.on('success', mensaje => {
            Swal.fire({ icon: "success", title: mensaje, showConfirmButton: false, timer: 1500 });
        });
        $wire.on('error', mensaje => {
            Swal.fire({ icon: "error", title: mensaje, showConfirmButton: false, timer: 1500 });
        });
    </script>
    @endscript

    @include('administrador.canchas.modal_cancha')
    @include('administrador.canchas.modal_solicitudes')

</div>