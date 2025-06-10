<div wire:ignore.self class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal_edit_agenda_a" tabindex="30000" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cancha :@if (isset($reservaform->reserva)) #{{$reservaform->reserva->id}}-{{$reservaform->reserva->cancha->name}} @endif</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" id="cerrar_modal_agenda_a" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
                <div class="col-12">
                    <i class="fas fa-arrow-left"></i>Llegada : @if(isset($reservaform->reserva)) {{$reservaform->reserva->fingreso}} @endif
                </div>
                <div class="col-12">
                    <i class="fas fa-arrow-right"></i>Salida : @if(isset($reservaform->reserva)) {{$reservaform->reserva->fsalida}} @endif
                </div>
                <div class="col-12">
                    <i class="fas fa-user"></i>Cliente : @if(isset($reservaform->reserva)) {{$reservaform->reserva->cliente->name}} @endif
                </div>
            </div>
            <div class="row align-items-center my-2">
                <div class="col-6">
                    @if(isset($reservaform->reserva))
                    @php
                        $color2 = match ($reservaform->reserva->estado) 
                            {
                                'Reservado' => 'btn-primary',   // Azul
                                'Utilizada' => 'btn-success',   // Verde
                                'Anulada'   => 'btn-danger',   // Rojo
                                default     => 'btn-primary',   // Gris por defecto
                            };
                    @endphp
                        <button  class="btn {{$color2}}">
                            {{$reservaform->reserva->estado}}
                        </button>
                    @endif
                </div>
                <div class="col-6">
                    <i class="fas fa-money-bill"></i> Precio:
                    @if(isset($reservaform->reserva))
                        {{$reservaform->subtotal}}
                    @endif
                </div>
                <div class="col-12 my-2">
                    @if(isset($reservaform->reserva->posventadetalle->posventa))
                    <b>COMPROBANTE: </b>
                    <span style="color: blue; cursor: pointer; text-decoration: underline dotted;" 
                          wire:click='descargar_venta_pdf({{ $reservaform->reserva->posventadetalle->posventa->id }})'
                          onmouseover="this.style.textDecoration='underline solid'"
                          onmouseout="this.style.textDecoration='underline dotted'">
                        {{ "SL_" . $reservaform->reserva->posventadetalle->posventa->id }} Descargar Comprobante
                    </span>
                    @endif
                </div>
                
            </div>
            @if(isset($reservaform->reserva))
            @if (!$reservaform->reserva->motivo_anulacion && $reservaform->reserva->posventa_detalle_id == NULL)
                <div class="row align-items-center my-2">
                    <div class="col-12 text-center fs-5">
                        Formulario de Anulación
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="text" class="form-control" wire:model='motivo_anulacion'>
                    </div>
                    <div class="col-12 col-sm-6">
                        <button class="btn btn-danger w-100" wire:target='solicitar_anulacion' wire:click='solicitar_anulacion'>Solicitar Anulación</button>
                    </div>
                    <div class="col-12">
                        @error('motivo_anulacion') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            @endif
            @if ($reservaform->reserva->motivo_anulacion)
                <div class="row align-items-center my-2">
                    <div class="col-12 text-center fs-5 text-danger">
                        Solicitud de Anulación - Motivo : {{$reservaform->reserva->motivo_anulacion}}
                    </div>
                </div>
            @endif
            @endif
          </div>
        </div>
      </div>
    </div>
</div>