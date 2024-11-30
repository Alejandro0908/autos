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

    //protected $model = Auto::class;
    public function definition()
    {
        return [
            //
            'modelo' => $this ->faker->sentence(),
            'descripcion' => $this ->faker->paragraph(),
            'precio' => $this->faker->randomFloat(),
            'estado' => $this ->faker->paragraph(),
        ];
    }
}
