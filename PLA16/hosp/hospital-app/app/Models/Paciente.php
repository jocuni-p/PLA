<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'paciente';  		// nombre de la tabla que usara el modelo
	protected $primaryKey = 'idpaciente';	// nombre de la primary key
	public $timestamps = false;				// desactivamos la actualizacion de timestamps

	protected $fillable = [
		'nif',
		'nombre',
		'apellidos',
		'fechaingreso',
		'fechaalta'
	];

	//ALTA. Metodo de alta del paciente en la BD
	public static function alta($datos) {
		$paciente = Paciente::create([
			'nif'			=> $datos['nif'],
			'nombre'		=> $datos['nombre'],
			'apellidos'		=> $datos['apellidos'],
			'fechaingreso'	=> $datos['fechaingreso'],
			'fechaalta'		=> null
		]);
		return $paciente;
	}

	// CONSULTA: consulta pacientes filtrados, limitados y ordenados
    public static function consulta($filtro = '', $limit = 5) //limit ha de ser cambiable por el combo
    {
        $query = self::query();

        // Filtro opcional por apellido
        if (!empty($filtro)) {
            $query->where('apellidos', 'like', '%' . $filtro . '%');
        }

        // Ordenar por nombre y apellidos
        $query->orderBy('nombre', 'asc')->orderBy('apellidos', 'asc');

        // Limitar cantidad
        $query->limit($limit);

        // Obtener resultados
        return $query->get();
    }
}
