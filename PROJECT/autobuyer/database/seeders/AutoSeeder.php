<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Auto;

class AutoSeeder extends Seeder
{
    public function run()
    {

		//Envuelvo el truncate para poder desactivar las restricciones de la FK y que se pueda borrar los datos
		DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // 🔸 Desactiva FK
		//borra todos los registros y reinicia a 0 el id autoincremental
		Auto::truncate(); //limpia todos los datos
		DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // 🔸 Reactiva FK
		
		//Opcion A: creo algunos registros con nombres reales
        DB::table('autos')->insert([
            [
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'precio' => 18000,
                'anio' => 2019,
                'kilometros' => 35000,
                'combustible' => 'gasolina',
				'img' => 'sinportada.jpg',
                'fecha_alta' => now(),
                'idcategoria' => 1,
            ],
            [
                'marca' => 'BMW',
                'modelo' => 'Serie 3',
                'precio' => 27000,
                'anio' => 2020,
                'kilometros' => 22000,
                'combustible' => 'diesel',
				'img' => 'sinportada.jpg',
                'fecha_alta' => now(),
                'idcategoria' => 2,
            ],
            [
                'marca' => 'Tesla',
                'modelo' => 'Model 3',
                'precio' => 40000,
                'anio' => 2021,
                'kilometros' => 12000,
                'combustible' => 'electrico',
				'img' => 'sinportada.jpg',
                'fecha_alta' => now(),
                'idcategoria' => 3,
            ],
            [
                'marca' => 'Renault',
                'modelo' => 'Clio',
                'precio' => 15000,
                'anio' => 2018,
                'kilometros' => 45000,
                'combustible' => 'gasolina',
                'fecha_alta' => now(),
                'idcategoria' => 1,
				'img' => 'sinportada.jpg',
            ],
            [
                'marca' => 'Audi',
                'modelo' => 'Q5',
                'precio' => 35000,
                'anio' => 2020,
                'kilometros' => 28000,
                'combustible' => 'hibrido',
				'img' => 'sinportada.jpg',
                'fecha_alta' => now(),
                'idcategoria' => 5,
            ],
        ]);

		//Opcion B: utilizo factory (crea registros inventados sin significado real)
		Auto::factory(10)->create();
    }
}