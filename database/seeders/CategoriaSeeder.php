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
        $categoria -> cat_cod = "1";
        $categoria -> name = "Lacteos";
        $categoria -> save();

        $categoria = new Categoria();
        $categoria -> cat_cod = "2";
        $categoria -> name = "Pan";
        $categoria -> save();

        $categoria = new Categoria();
        $categoria -> cat_cod = "3";
        $categoria -> name = "Snacks";
        $categoria -> save();

        $categoria = new Categoria();
        $categoria -> cat_cod = "4";
        $categoria -> name = "Gaseosas";
        $categoria -> save();

        $categoria = new Categoria();
        $categoria -> cat_cod = "5";
        $categoria -> name = "Carnes";
        $categoria -> save();
    }
}
