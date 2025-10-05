<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    /** @use HasFactory<\Database\Factories\PeliculaFactory> */
    use HasFactory;

	//defino la tabla
	protected $table = 'peliculas';
	protected $fillable = [
		'titulo',
		'direccion',
		'anio',
		'sinopsis',
		'img'
	];

	//CONSULTA: metodo para devolver las peliculas ordenadas por titulo
	public static function consulta() {
		return self::orderBy('titulo')->get();
	}

	//Si no hubieramos puesto nuestra base de datos, Laravel anyadiria
	// las columnas de timestamp created_at y updated_at.
	//No actualizar las columnas de timestamp.
	public $timestamps = false;

	//ALTA
	public static function alta($datos) {
		return Pelicula::create([
			'titulo'	=> $datos['titulo'],
			'direccion'	=> $datos['direccion'],
			'anio'		=> $datos['anio'],
			'sinopsis'	=> $datos['sinopsis'],
			'img'		=> $datos['portada']
		]);
	}
}
