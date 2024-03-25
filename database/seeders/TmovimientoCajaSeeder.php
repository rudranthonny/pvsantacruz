<?php

namespace Database\Seeders;

use App\Models\TmovimientoCaja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TmovimientoCajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $n_tmovmiento_caja = new TmovimientoCaja();
        $n_tmovmiento_caja->name = 'Apertura Caja';
        $n_tmovmiento_caja->signo = '+';
        $n_tmovmiento_caja->save();

        $n_tmovmiento_caja = new TmovimientoCaja();
        $n_tmovmiento_caja->name = 'Gasto';
        $n_tmovmiento_caja->signo = '-';
        $n_tmovmiento_caja->save();

        $n_tmovmiento_caja = new TmovimientoCaja();
        $n_tmovmiento_caja->name = 'Venta';
        $n_tmovmiento_caja->signo = '-';
        $n_tmovmiento_caja->save();
    }
}
