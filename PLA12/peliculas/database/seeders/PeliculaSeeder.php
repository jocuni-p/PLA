<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pelicula;


class PeliculaSeeder extends Seeder
{

    public function run(): void
    {
		Pelicula::truncate(); //borra todos los registros y reinicia a 0 el id autoincremental

		//Opcion A: creo algunos registros reales
		DB::table('peliculas')->insert([
            [
                'titulo'   => 'Al Padrino',
                'direccion'=> 'Francis Ford Coppola',
                'anio'     => 1972,
                'sinopsis' => 'La historia de la familia Corleone.',
                'img'      => 'sinportada.jpg'
            ],
            [
                'titulo'   => 'Bulp Fiction',
                'direccion'=> 'Quentin Tarantino',
                'anio'     => 1994,
                'sinopsis' => 'Historias entrelazadas en Los Ángeles criminal.',
                'img'      => 'sinportada.jpg'
            ],
            [
                'titulo'   => 'Inception',
                'direccion'=> 'Christopher Nolan',
                'anio'     => 2010,
                'sinopsis' => 'Un ladrón roba secretos infiltrándose en los sueños.',
                'img'      => 'sinportada.jpg'
            ],
            [
                'titulo'   => 'Cinema Paradiso',
                'direccion'=> 'Giuseppe Tornatore',
                'anio'     => 1988,
                'sinopsis' => 'Un cine de pueblo y la amistad entre un niño y un proyeccionista.',
                'img'      => 'sinportada.jpg'
            ]
        ]); 

		//Opcion B: utilizo factory (crea registros inventados sin significado real)
		Pelicula::factory(10)->create();
    }
}
