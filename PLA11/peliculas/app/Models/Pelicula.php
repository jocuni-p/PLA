<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    /** @use HasFactory<\Database\Factories\PeliculaFactory> */
    use HasFactory;

	protected $table = 'peliculas';
	protected $fillable = [
		'titulo',
		'direccion',
		'anio',
		'sinopsis',
		'img'
	];
	//No actualizar las columnas de timestamp
	//que si no hubieramos puesto nuestra base 
	//de datos el anyadiria
	public $timestamps = false;

}
