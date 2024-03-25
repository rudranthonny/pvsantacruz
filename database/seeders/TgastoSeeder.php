<?php

namespace Database\Seeders;

use App\Models\Tgasto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TgastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $n_tgasto = new Tgasto();
        $n_tgasto->name = 'Retiros mini';
        $n_tgasto->save();

        $n_tgasto = new Tgasto();
        $n_tgasto->name = 'Compras';
        $n_tgasto->save();

        $n_tgasto = new Tgasto();
        $n_tgasto->name = 'Sueldos';
        $n_tgasto->save();
    }
}
