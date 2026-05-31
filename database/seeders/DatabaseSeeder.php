<?php

namespace Database\Seeders;

use App\Models\Medicos;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (Medicos::count() > 0) {
            return;
        }

        Medicos::create([
            'nombre' => 'Dra. Carolina Mendoza Lopez',
            'especialidad' => 'Cardiologia',
            'fnac' => '1978-04-12',
            'aniotituto' => 2002,
            'celular' => '3001234567',
            'foto' => 'https://randomuser.me/api/portraits/women/44.jpg',
        ]);

        Medicos::create([
            'nombre' => 'Dr. Andres Felipe Ramirez Gil',
            'especialidad' => 'Neurologia',
            'fnac' => '1985-09-23',
            'aniotituto' => 2010,
            'celular' => '3109876543',
            'foto' => 'https://randomuser.me/api/portraits/men/32.jpg',
        ]);

        Medicos::create([
            'nombre' => 'Dr. Ricardo Jose Torres Mejia',
            'especialidad' => 'Pediatria',
            'fnac' => '1975-11-30',
            'aniotituto' => 2000,
            'celular' => '3205550199',
            'foto' => 'https://randomuser.me/api/portraits/men/75.jpg',
        ]);
    }
}
