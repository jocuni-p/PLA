<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pelicula;


class PeliculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		//Opcion A: Utilizamos el modelo generico DB
/*        DB::table('peliculas')->insert([
            [
                'titulo'   => 'El Padrino',
                'direccion'=> 'Francis Ford Coppola',
                'anio'     => 1972,
                'sinopsis' => 'La historia de la familia Corleone.',
                'img'      => 'elpadrino.jpg'
            ],
            [
                'titulo'   => 'Pulp Fiction',
                'direccion'=> 'Quentin Tarantino',
                'anio'     => 1994,
                'sinopsis' => 'Historias entrelazadas en Los Ángeles criminal.',
                'img'      => 'pulpfiction.jpg'
            ],
            [
                'titulo'   => 'Inception',
                'direccion'=> 'Christopher Nolan',
                'anio'     => 2010,
                'sinopsis' => 'Un ladrón roba secretos infiltrándose en los sueños.',
                'img'      => 'inception.jpg'
            ],
            [
                'titulo'   => 'Cinema Paradiso',
                'direccion'=> 'Giuseppe Tornatore',
                'anio'     => 1988,
                'sinopsis' => 'Un cine de pueblo y la amistad entre un niño y un proyeccionista.',
                'img'      => 'cinemaparadiso.jpg'
            ]
        ]); */
		//Opcion B: utilizamos la factory
		Pelicula::factory(10)->create();
    }
}
