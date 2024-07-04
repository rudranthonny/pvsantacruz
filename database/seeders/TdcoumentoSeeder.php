<?php

namespace Database\Seeders;

use App\Models\Tdocumento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TdcoumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $n_tdocumento = new Tdocumento();
        $n_tdocumento->nombre = 'NIT';
        $n_tdocumento->save();
        $n_tdocumento = new Tdocumento();
        $n_tdocumento->nombre = 'DPI';
        $n_tdocumento->save();
        $n_tdocumento = new Tdocumento();
        $n_tdocumento->nombre = 'EXTRANJERO';
        $n_tdocumento->save();
    }
}
