<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function apiReservas(Request $request)
{
    $start = $request->start;
    $end = $request->end;
    $canchaId = $request->cancha_id;

    $reservas = Reserva::where('cancha_id', $canchaId)
        ->where('activo', 1)
        ->whereBetween('fingreso', [$start, $end])
        ->get();


    return $reservas->map(function ($reserva) {
    $color = match ($reserva->estado) {
        'Reservado' => '#007bff',
        'Utilizada' => '#28a745',
        'Anulada'   => '#dc3545',
        default     => '#6c757d',
    };

    $nombre_abc = $reserva->gratuito ? 'GRATUITO#' . $reserva->id : 'R#' . $reserva->id;
    $color = $reserva->gratuito ? '#ffff00' : $color;
    return [
        'id' => $reserva->id,
        'title' => $nombre_abc,
        'start' => $reserva->fingreso,
        'end' => $reserva->fsalida,
        'color' => $color,
    ];
});
}

}
