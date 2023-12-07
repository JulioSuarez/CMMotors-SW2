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
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_cliente' => function () {
                return Cliente::factory()->create()->ci;
            },
            'id_empleado' => function () {
                return Empleado::factory()->create()->ci;
            },
            'id_datos_generales' => function () {
                return DatosGeneral::factory()->create()->id;
            },
            // Aquí puedes definir los demás campos del modelo Venta
        ];
    }

    /**
     * After creating the Venta, create the related Productos and DetalleVentas.
     */
    public function configure()
    {
        return $this->afterCreating(function (Venta $venta) {
            $productos = Producto::factory(random_int(1, 5))->create(['venta_id' => $venta->id]);
            foreach ($productos as $producto) {
                DetalleVenta::factory()->create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    // Aquí puedes definir los demás campos del modelo DetalleVenta
                ]);
            }
        });
    }
}
