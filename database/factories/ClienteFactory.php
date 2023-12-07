<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Generator as Faker;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\DatosGeneral;
use App\Models\Producto;
use App\Models\DetalleVenta;
use App\Models\Venta;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // protected $fillable = [
            //     'ci',
            //     'nombre',
            //     'empresa',
            //     'nit',
            //     'correo',
            //     'telefono',
            //     'direccion',
            //     'id_cliente',
            // ];
            // protected $primaryKey = 'ci';

            // public $timestamps = false;
            //
            //cliente create 50
            'ci' => $this->faker->unique()->numberBetween($min = 1000000, $max = 9999999),
            'nombre' => $this->faker->name,
            'empresa' => $this->faker->company,
            'nit' => $this->faker->unique()->numberBetween($min = 1000000, $max = 9999999),
            'correo' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->unique()->numberBetween($min = 1000000, $max = 9999999),
            'direccion' => $this->faker->address,
            'id_cliente' => $this->faker->unique()->numberBetween($min = 1000000, $max = 9999999),
        ];
    }
}
