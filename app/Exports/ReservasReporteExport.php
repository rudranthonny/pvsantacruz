<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ReservasReporteExport implements FromView, WithEvents
{
    public function __construct(
        public $reservas,
        public $ingresos,
        public $reservas_por_cancha,
        public $gratuitas_por_cliente,
        public $fecha_inicio,
        public $fecha_fin,
        public $exportado_por
    ) {}

    public function view(): View
    {
        return view('exports.reservas-reporte', [
            'reservas' => $this->reservas,
            'ingresos' => $this->ingresos,
            'reservas_por_cancha' => $this->reservas_por_cancha,
            'gratuitas_por_cliente' => $this->gratuitas_por_cliente,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Estilo general
                $sheet->getDelegate()->getDefaultRowDimension()->setRowHeight(18);
                $sheet->getDelegate()->getStyle('A1:K1000')->getFont()->setName('Calibri')->setSize(11);

                // Título principal
                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:F2');
                $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
                $sheet->getStyle('A2')->getFont()->setSize(12);

                // Estilos para encabezados de tablas conocidas
                $sheet->getStyle('A6:F6')->getFill()->setFillType('solid')->getStartColor()->setRGB('D9E1F2');
                $sheet->getStyle('A6:F6')->getFont()->setBold(true);
                $sheet->getStyle('A6:F6')->getBorders()->getAllBorders()->setBorderStyle('thin');

                $sheet->getStyle('A13:B13')->getFill()->setFillType('solid')->getStartColor()->setRGB('D9E1F2');
                $sheet->getStyle('A13:B13')->getFont()->setBold(true);
                $sheet->getStyle('A13:B13')->getBorders()->getAllBorders()->setBorderStyle('thin');

                $sheet->getStyle('A17:K17')->getFill()->setFillType('solid')->getStartColor()->setRGB('D9E1F2');
                $sheet->getStyle('A17:K17')->getFont()->setBold(true);
                $sheet->getStyle('A17:K17')->getBorders()->getAllBorders()->setBorderStyle('thin');

                // Bordes para toda la tabla de reservas (ajustado dinámicamente)
                $lastRow = 17 + count($this->reservas);
                $sheet->getStyle("A17:K{$lastRow}")->getBorders()->getAllBorders()->setBorderStyle('thin');

                // Ajuste automático de ancho columnas A-K
                foreach (range('A', 'K') as $col) {
                    $sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
                $sheet->setCellValue('A' . ($lastRow + 3), 'Exportado por: ' . auth()->user()->name ?? 'Sistema');
                $sheet->setCellValue('A' . ($lastRow + 3), 'Exportado por: ' . $this->exportado_por);
            }
        ];
    }

    public function drawings()
{
    $drawing = new Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo de Reporte');
    $drawing->setPath(public_path('imagenes/logo.png')); // ruta al logo
    $drawing->setHeight(80); // altura del logo en px
    $drawing->setCoordinates('A1'); // celda donde aparecerá
    $drawing->setOffsetX(5);
    $drawing->setOffsetY(5);

    return [$drawing];
}

}
