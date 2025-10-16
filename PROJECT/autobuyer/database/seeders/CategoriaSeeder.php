<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
		//Envuelvo el truncate para poder desactivar las restricciones de la FK y que se pueda borrar los datos
		DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // 🔸 Desactiva FK
        DB::table('categorias')->truncate(); //limpia todos los datos
		DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // 🔸 Reactiva FK

        DB::table('categorias')->insert([
            ['idcategoria' => 1, 'nombre' => 'coche pequeño'],
            ['idcategoria' => 2, 'nombre' => 'sedan'],
            ['idcategoria' => 3, 'nombre' => 'coupe'],
            ['idcategoria' => 4, 'nombre' => 'suv'],
            ['idcategoria' => 5, 'nombre' => 'familiar'],
            ['idcategoria' => 6, 'nombre' => 'monovolumen'],
            ['idcategoria' => 7, 'nombre' => 'cabrio'],
        ]);
    }
}
