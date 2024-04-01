<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $marca = new Marca();
        $marca -> name = "marca1";
        $marca -> description = "desc1";
        $marca -> image = "image1";
        $marca -> save();

        $marca = new Marca();
        $marca -> name = "marca2";
        $marca -> description = "desc2";
        $marca -> image = "image2";
        $marca -> save();

        $marca = new Marca();
        $marca -> name = "marca3";
        $marca -> description = "desc3";
        $marca -> image = "image3";
        $marca -> save();

    }
}
