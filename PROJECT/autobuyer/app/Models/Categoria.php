<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
	public $timestamps = null;

	public static function consulta() {
		return Categoria::orderBy('nombre')->get();
		
	}

}
