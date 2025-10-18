<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    /** @use HasFactory<\Database\Factories\PeliculaFactory> */
    use HasFactory;

	//defino la tabla
	protected $table = 'autos';
	protected $fillable = [
		'marca',
		'modelo',
		'precio',
		'anio',
		'kilometros',
		'combustible',
		'img',
		'idcategoria'
	];

	//CONSULTA: metodo para devolver los vehículos ordenados por marca
	public static function consulta() {
		return self::orderBy('marca')->get();
	}

	//Si no hubieramos puesto nuestra base de datos, Laravel anyadiria
	// las columnas de timestamp created_at y updated_at.
	//No actualizar las columnas de timestamp.
	public $timestamps = false;

	//ALTA
	public static function alta($datos) {
		return Auto::create([
			'marca'			=> $datos['marca'],
			'modelo'		=> $datos['modelo'],
			'precio'		=> $datos['precio'],
			'anio'			=> $datos['anio'],
			'kilometros'	=> $datos['kilometros'],
			'combustible'	=> $datos['combustible'],
			'img'			=> $datos['portada'],
			'idcategoria' 	=> $datos['idcategoria']
		]);
	}
}
