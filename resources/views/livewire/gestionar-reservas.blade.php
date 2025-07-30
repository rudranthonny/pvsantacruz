<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Reserva de la Cancha {{$cancha->name}}
        </div>
    </div>
    <div wire:ignore id='calendar' ></div>
    <!--claendario-->
    @push('js')
    <script>
        const baseRutaReserva = @json(route('admin.reservas_modificar', ['id' => '__ID__']));
    </script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() 
        {
              calendarEl = document.getElementById('calendar');
              calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay' // 👈 Agregadas vistas semana y día
            },
            locale: 'es', // 👈 Idioma español
            dayMaxEventRows: true, // for all non-TimeGrid views
            views: {
                timeGrid: {
                dayMaxEventRows: 3 // adjust to 6 only for timeGridWeek/timeGridDay
                }
            },
            slotLabelFormat: {
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short',
                hour12: true
            },
            eventTimeFormat: {
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short',
                hour12: true
            },
            dateClick:function(info)
            {
                var actual =new Date().toDateString();
                var actual = new Date(actual);

                if(info.date >= actual)
                {
                    $('#modal_reserva').modal('toggle');
                    window.Livewire.dispatch('abrir-modal-booking',{ reserva:null,info:info});
                } else
                {
                    alert("Error: No se puede solicitar una cita en una fecha vencida");
                }
            },
            eventClick:function(info)
            {
                /*const modal = $('#modal_edit_agenda_a');
                // Centrado horizontal (50% pantalla) y arriba (por ejemplo, 50px desde el top)
                modal.css({
                    position: 'fixed',
                    top: '50px',
                    left: '50%',
                    transform: 'translateX(-50%)',
                    zIndex: 1055
                });

                modal.modal('show');
                window.Livewire.dispatch('abrir-modal-booking',{ reserva:info.event.id,info:null});*/
                const id = info.event.id;
                const url = baseRutaReserva.replace('__ID__', id);
                window.open(url, '_blank');
            },
            events: {
                url: '{{ url("admin/api/reservas") }}', // Nueva ruta API en Laravel
                method: 'GET',
                extraParams: function() {
                return {
                    
                    cancha_id: @json($cancha->id),
                    
                };
                },
                failure: function() {
                alert('Error al cargar las reservas.');
                },
            },
          });
          calendar.render();
        });

        function actualizar_calendario(reservacion) {
           if (!calendar) return;
            calendar.refetchEvents(); 
        }

        function mostrar_avertencia_booking_eliminar(id_eliminar)
        {
            Swal.fire({
            title: 'Estas Seguro',
            text: "se Cancela la reserva",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, !Cancelar Reserva!'
            }).then((result) => {
                if (result.isConfirmed) {
                        @this.dispatch('eliminar-booking-seleccionado',{ booking: id_eliminar });
                }
            })
        }

        function mostrar_avertencia_cambio_estatus(id_booking,nombre_status,color)
        {
            Swal.fire({
            title: 'Estas Seguro del cambio',
            text: "se Cambiara el estado a "+nombre_status,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: color,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, !Cambiar Reserva!'
            }).then((result) => {
                if (result.isConfirmed) {
                        @this.dispatch('cambiar-estado-estatus_bokking',{ booking: id_booking });
                }
            })
        }
    </script>
    @endpush
    <!--modal_reserva-->
    @include('administrador.reservas.modal_reserva')
    <!--modal para cambiar estado e información basica-->
    @include('administrador.reservas.modal_reserva2')
    <!--end-->
</div>
