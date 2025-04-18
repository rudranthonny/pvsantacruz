<?php

namespace App\Livewire;

use App\Exports\ReservasReporteExport;
use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Reserva;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;

class GestionarReservasReporte extends Component
{
    public $fecha_inicio, $fecha_fin;
    public $filtro_tipo = 'mes'; // opciones: mes, rango

    public function descargar_reporte_reservas_excel()
    {
            $reservas = $this->reservas;
            $ingresos = $this->ingresosTotales;
            $resumen = $this->reservasPorCancha;
            $gratuitas = $this->gratuitasPorCliente;
            $nombre_usuario = auth()->user()?->name ?? 'Sistema';

            return Excel::download(
                new ReservasReporteExport(
                    $reservas,
                    $ingresos,
                    $resumen,
                    $gratuitas,
                    $this->fecha_inicio,
                    $this->fecha_fin,
                    $nombre_usuario
                ),
                'Reporte_Reservas_' . now()->format('Y-m-d_H-i') . '.xlsx'
            );
    }

    public function mount()
    {
        $this->fecha_inicio = now()->startOfMonth()->format('Y-m-d');
        $this->fecha_fin = now()->endOfMonth()->format('Y-m-d');
    }

    public function getReservasProperty()
    {
        return Reserva::with('cancha', 'cliente')
            ->whereBetween('fingreso', [$this->fecha_inicio, $this->fecha_fin])
            ->get();
    }

    public function getIngresosTotalesProperty()
    {
        return $this->reservas->where('gratuito', false)->whereNull('motivo_anulacion')->whereNotNull('posventa_detalle_id')->sum('subtotal');
    }

    public function getReservasPorCanchaProperty()
    {
        return $this->reservas
            ->groupBy('cancha_id')
            ->map(function ($items) {
                return [
                    'cancha' => $items->first()->cancha->name ?? '—',
                    'total' => $items->count(),
                    'reservadas' => $items->where('estado', 'Reservado')->whereNull('motivo_anulacion')->whereNull('posventa_detalle_id')->count(),
                    'solicitudes' => $items->where('estado', 'Reservado')->whereNotNull('motivo_anulacion')->whereNull('posventa_detalle_id')->count(),
                    'utilizadas' => $items->where('estado', 'Utilizada')->count(),
                    'anuladas' => $items->where('estado', 'Anulada')->count(),
                ];
            });
    }

    public function getGratuitasPorClienteProperty()
    {
        return Cliente::with(['reservas' => function ($q) {
            $q->whereBetween('fingreso', [$this->fecha_inicio, $this->fecha_fin]);
        }])->get()->map(function ($cliente) {
            $gratuitas = $cliente->reservas->where('gratuito', true)->sum('horas');
            return [
                'cliente' => $cliente->name,
                'gratuitas' => $gratuitas,
            ];
        })->filter(fn($item) => $item['gratuitas'] > 0);
    }

    public function descargar_reporte_reservas_pdf()
    {
        $configuracion = Configuracion::first();

        $reservas = Reserva::with('cancha', 'cliente')
            ->whereBetween('fingreso', [$this->fecha_inicio, $this->fecha_fin])
            ->get();

        $ingresos = $reservas
            ->where('gratuito', false)
            ->whereNull('motivo_anulacion')
            ->whereNotNull('posventa_detalle_id')
            ->sum('subtotal');

        $reservas_por_cancha = $reservas
            ->groupBy('cancha_id')
            ->map(function ($items) {
                return [
                    'cancha' => $items->first()->cancha->name ?? '—',
                    'total' => $items->count(),
                    'reservadas' => $items->where('estado', 'Reservado')->whereNull('motivo_anulacion')->whereNull('posventa_detalle_id')->count(),
                    'solicitudes' => $items->where('estado', 'Reservado')->whereNotNull('motivo_anulacion')->whereNull('posventa_detalle_id')->count(),
                    'utilizadas' => $items->where('estado', 'Utilizada')->count(),
                    'anuladas' => $items->where('estado', 'Anulada')->count(),
                ];
            });

        $gratuitas_por_cliente = Cliente::with(['reservas' => function ($q) {
            $q->whereBetween('fingreso', [$this->fecha_inicio, $this->fecha_fin]);
        }])->get()->map(function ($cliente) {
            $gratuitas = $cliente->reservas->where('gratuito', true)->sum('horas');
            return [
                'cliente' => $cliente->name,
                'gratuitas' => $gratuitas,
            ];
        })->filter(fn($item) => $item['gratuitas'] > 0);

        $nombre_archivo = 'ReporteDeReservas-' . now()->format('Y-m-d_H-i') . '.pdf';

        $pdf = FacadePdf::loadView('administrador.reservas.reporte_reservas_pdf', [
            'reservas' => $reservas,
            'ingresos' => $ingresos,
            'reservas_por_cancha' => $reservas_por_cancha,
            'gratuitas_por_cliente' => $gratuitas_por_cliente,
            'configuracion' => $configuracion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
        ])->setPaper('a4', 'landscape');

        return response()->streamDownload(fn () => print($pdf->output()), $nombre_archivo);
    }

    public function render()
    {
        return view('livewire.gestionar-reservas-reporte');
    }
}