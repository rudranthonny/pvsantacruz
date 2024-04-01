<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoria = new Categoria();
        $categoria -> cat_cod = "locetas";
        $categoria -> name = "Locetas";
        $categoria -> save();

        $categoria = new Categoria();
        $categoria -> cat_cod = "herramient_de_jardin";
        $categoria -> name = "Herremientas de Jardin ";
        $categoria -> save();
    }
}
