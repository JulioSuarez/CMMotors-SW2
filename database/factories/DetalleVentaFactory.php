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
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleVenta>
 */
class DetalleVentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'detalles' => $this->faker->text(),
        'cantidad' => $this->faker->randomNumber(),
        'precio' => $this->faker->randomFloat(),
        'id_producto' => function () {
            return Producto::factory()->create()->id;
        },
        'id_venta' => function () {
            return Venta::factory()->create()->id;
        },
        'precio_producto_unitario' => $this->faker->randomFloat(),
        'costo_producto' => $this->faker->randomFloat(),
        'unidad' => $this->faker->word(),
        ];
    }
}
