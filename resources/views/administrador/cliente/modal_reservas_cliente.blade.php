<!-- Modal Historial de Reservas -->
<div wire:ignore.self class="modal fade" id="modalHistorialReservas" tabindex="-1" aria-labelledby="modalHistorialReservasLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-white">
          <h5 class="modal-title">Historial de Reservas: {{ $historial_reservas_cliente?->name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          @if ($historial_reservas_cliente)
           <div class="row mb-4">
                <div class="col-md-4 mb-2">
                    <div class="card text-white bg-primary shadow h-100">
                        <div class="card-body text-center">
                            <h6 class="card-title">Partidas Jugadas</h6>
                            <h3 class="fw-bold">
                                {{ $historial_reservas_cliente->reservas()->where('estado','Utilizada')->count() }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="card text-white bg-success shadow h-100">
                        <div class="card-body text-center">
                            <h6 class="card-title">Gratuitas Obtenidas</h6>
                            <h3 class="fw-bold">
                                {{ floor($historial_reservas_cliente->reservas()->where('gratuito',false)->where('estado','Utilizada')->sum('horas')) }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="card text-white bg-warning shadow h-100">
                        <div class="card-body text-center">
                            <h6 class="card-title">Gratuitas Usadas</h6>
                            <h3 class="fw-bold">
                                {{ $historial_reservas_cliente->reservas()->where('gratuito',true)->whereIn('estado',['Reservado','Utilizada'])->sum('horas') }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        
  
              <table class="table table-bordered table-hover">
                <thead class="table-dark text-center">
                  <tr>
                    <th>Fecha</th>
                    <th>Hora Ingreso</th>
                    <th>Hora Salida</th>
                    <th>Horas</th>
                    <th>Cancha</th>
                    <th>Gratuito</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($reservas_historial as $reserva)
                  <tr class="text-center">
                    <td>{{ \Carbon\Carbon::parse($reserva->fingreso)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva->fingreso)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva->fsalida)->format('H:i') }}</td>
                    <td>{{ $reserva->horas }}</td>
                    <td>{{ $reserva->cancha->name ?? '—' }}</td>
                    <td>
                      @if($reserva->gratuito)
                        <span class="badge bg-success">Sí</span>
                      @else
                        <span class="badge bg-secondary">No</span>
                      @endif
                    </td>
                    <td>
                      @if($reserva->estado == 'Utilizada')
                        <span class="badge bg-primary">{{ $reserva->estado }}</span>
                      @elseif($reserva->estado == 'Reservado')
                        <span class="badge bg-warning text-dark">{{ $reserva->estado }}</span>
                      @else
                        <span class="badge bg-danger">{{ $reserva->estado }}</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  