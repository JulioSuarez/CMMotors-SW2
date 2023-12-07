<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Generator as Faker;
use App\Models\DatosGeneral;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DatoGeneral>
 */
class DatoGeneralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //atributos de datosgeneral: id,tipo_de_cambio,forma_pago,cheque,cuenta_bancaria,entrega,nota
            //datosgeneral create 1
            'tipo_de_cambio' => $this->faker->numberBetween($min = 6.8, $max = 6.9),
            'forma_pago' => $this->faker->randomElement($array = array ('Efectivo','Cheque','Transferencia')),
            'cheque' => $this->faker->numberBetween($min = 1000000, $max = 9999999),
            'cuenta_bancaria' => $this->faker->numberBetween($min = 1000000, $max = 9999999),
            'entrega' => $this->faker->randomElement($array = array ('Entregado','Pendiente')),
            'nota' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
