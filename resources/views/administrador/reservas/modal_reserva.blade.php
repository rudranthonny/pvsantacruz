
<div wire:ignore.self class="modal fade" id="modal_reserva" tabindex="4000" aria-labelledby="modal_reserva_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal_reserva_label">{{$titulo_agenda}} Reserva</h1>
          <button type="button" class="btn-close" id="cerrar_ventana_modal_reserva" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 p-2">
                    <div class="row my-2">
                        <div class="col-12 col-sm-4 my-2">
                            <label for="">B.Cliente @if($scliente) <span style="color:red;">Falta {{$scliente->reservas_faltantes}} fecha(s)@if($scliente->fecha_proxima),{{$scliente->fecha_proxima}}@endif   </span> @endif</label>
                            <input type="text" class="form-control" wire:model.live='nro_documento' placeholder="nro_documento">
                            @error('nro_documento')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 col-sm-4 my-2">
                            <label for="">Nombre del Cliente</label>
                            <input type="text" class="form-control" @if ($scliente) disabled @endif  wire:model='nombre_cliente' placeholder="Nombre Cliente">
                            @error('nombre_cliente')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 col-sm-4 my-2">
                            <label for="">Telefono del Cliente</label>
                            <input type="text" class="form-control" @if ($scliente) disabled @endif  wire:model='telefono_cliente' placeholder="Telefono Cliente">
                            @error('telefono_cliente')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12 col-sm-4">
                            <label for="fecha_inicio">Fecha Inicio</label>
                            <input type="date" id='fecha_inicio'  wire:model.live='finicio' class="form-control">
                            @error('finicio')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="fecha_inicio">Fecha Final</label>
                            <input type="date" id='fecha_final'  wire:model.live='ffinal' class="form-control">
                            @error('ffinal')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="time_hora">Hora</label>
                            <input type="time" id='time_hora'  wire:model.live='time' class="form-control">
                            @error('time')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="cantidad_horas">Cantidad Horas</label>
                            <input type="number" id='cantidad_horas'  wire:model.live='cantidad_horas' class="form-control">
                            @error('cantidad_horas')<div class="p-1" style="color:red;"> {{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 col-sm-12 my-2">
                            <label>Días de la semana:</label><br>
                            @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'] as $i => $dia)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" wire:model="dias_semana" value="{{ $i }}">
                                    <label class="form-check-label">{{ $dia }}</label>
                                </div>
                            @endforeach
                            @error('dias_semana')<div class="text-danger small"> {{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="display: block;">
            <div class="row">
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click='save_reserva'>{{$titulo_agenda}} Reservar</button>
                    @php
                    $puede_gratis = isset($scliente->reservas_gratuitas_disponibles) 
                        && $this->horas_solicitadas > 0 
                        && $scliente->reservas_gratuitas_disponibles >= $this->horas_solicitadas;
                    @endphp

                    @if ($puede_gratis)
                        <button type="button" class="btn btn-success" wire:click="save_reserva_gratuita">
                            Crear Reserva Gratuita ({{$scliente->reservas_gratuitas_disponibles}}h disponibles)
                        </button>
                    @endif
                </div>
            </div>

        </div>
      </div>
    </div>
    @script
        <script>
            $wire.on('cerrar_modal_reserva', reservacion => {
                actualizar_calendario(reservacion);
                ventana = document.getElementById('cerrar_ventana_modal_reserva').click();
            });
        </script>
    @endscript
</div>