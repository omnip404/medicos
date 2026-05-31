<?php

namespace Database\Factories;

use App\Models\Medicos;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicosFactory extends Factory
{
    protected $model = Medicos::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'especialidad' => fake()->word(),
            'fnac' => fake()->date(),
            'aniotituto' => fake()->year(),
            'celular' => fake()->unique()->phoneNumber(),
            'foto' => null,
        ];
    }
}
