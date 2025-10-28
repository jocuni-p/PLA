<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auto>
 */
class AutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $combustibles = ['gasolina', 'diesel', 'hibrido', 'electrico', 'hibrido enchufable', 'gas'];

        return [
            'marca'        	=> $this->faker->randomElement(['Toyota', 'BMW', 'Audi', 'Renault', 'Seat', 'Ford', 'Tesla', 'Mercedes']),
            'modelo'       	=> fake()->lexify('Modelo ???'),
            'precio'       	=> $this->faker->numberBetween(1000, 60000),
            'anio'         	=> $this->faker->year(),
            'kilometros'   	=> $this->faker->numberBetween(10000, 250000),
            'combustible'	=> $this->faker->randomElement($combustibles),
			'img'			=> 'sinportada.jpg',
            'fecha_alta'   	=> now(),
            'idcategoria'  	=> $this->faker->numberBetween(1, 7),
        ];
    }
}