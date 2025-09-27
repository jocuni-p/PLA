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
	
	//No actualiza las columnas de timestamp,
	//si no hubieramos puesto nuestra base 
	//de datos Laravel anyadiria 
	public $timestamps = false;

}
