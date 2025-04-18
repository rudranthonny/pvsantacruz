<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Reserva de la Cancha {{$cancha->name}}
        </div>
    </div>
    <div wire:ignore id='calendar' ></div>
    <!--claendario-->
    @push('js')
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
                $('#modal_edit_agenda_a').css('top', info.jsEvent.screenY-100);
                $('#modal_edit_agenda_a').css('left',info.jsEvent.screenX-745);
                $('#modal_edit_agenda_a').modal('toggle');
                window.Livewire.dispatch('abrir-modal-booking',{ reserva:info.event.id,info:null});
            },
            events: @json($reservaciones),
          });
          calendar.render();
        });

        function actualizar_calendario(reservacion)
        {
            calendarEl = document.getElementById('calendar');
              calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            locale: 'es',
            dayMaxEventRows: true, // for all non-TimeGrid views
            views: {
                timeGrid: {
                dayMaxEventRows: 6 // adjust to 6 only for timeGridWeek/timeGridDay
                }
            },
            dateClick:function(info){
                
                var actual =new Date().toDateString();
                var actual = new Date(actual);

                if(info.date >= actual)
                {
                    $('#modal_reserva').modal('toggle');
                    window.Livewire.dispatch('abrir-modal-booking',{ reserva:null,info:info});
                }
                else
                {
                    alert("Error: No se puede solicitar una cita en una fecha vencida");
                }
            },
            eventClick:function(info){
                $('#modal_edit_agenda_a').css('top', info.jsEvent.screenY-100);
                $('#modal_edit_agenda_a').css('left',info.jsEvent.screenX-745);
                $('#modal_edit_agenda_a').modal('toggle');
                window.Livewire.dispatch('abrir-modal-booking',{ reserva:info.event.id,info:null});
            },
            events: JSON.parse(reservacion),
          });

          calendar.setOption('locale','es');
          calendar.render();

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

        function actualizar_calendario(reservacion)
        {
            calendarEl = document.getElementById('calendar');
              calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay' // 👈 Agregadas vistas semana y día
            },
            dayMaxEventRows: true, // for all non-TimeGrid views
            views: {
                timeGrid: {
                dayMaxEventRows: 6 // adjust to 6 only for timeGridWeek/timeGridDay
                }
            },
            dateClick:function(info){
                
                var actual =new Date().toDateString();
                var actual = new Date(actual);

                if(info.date >= actual)
                {
                    $('#modal_reserva').modal('toggle');
                    window.Livewire.dispatch('abrir-modal-booking',{ reserva:null,info:info});
                }
                else
                {
                    alert("Error: No se puede solicitar una cita en una fecha vencida");
                }
            },
            eventClick:function(info){
                $('#modal_edit_agenda_a').css('top', info.jsEvent.screenY-100);
                $('#modal_edit_agenda_a').css('left',info.jsEvent.screenX-745);
                $('#modal_edit_agenda_a').modal('toggle');
                window.Livewire.dispatch('abrir-modal-booking',{ reserva:info.event.id,info:null});
            },
            events: JSON.parse(reservacion),
          });

          calendar.setOption('locale','es');
          calendar.render();

        }
    </script>
    @endpush
    <!--modal_reserva-->
    @include('administrador.reservas.modal_reserva')
    <!--modal para cambiar estado e información basica-->
    @include('administrador.reservas.modal_reserva2')
    <!--end-->
</div>
