<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            ['name' => 'Cardiología', 'description' => 'Enfermedades del corazón y del sistema circulatorio.'],
            ['name' => 'Pediatría', 'description' => 'Atención médica de bebés, niños y adolescentes.'],
            ['name' => 'Dermatología', 'description' => 'Diagnóstico y tratamiento de enfermedades de la piel.'],
            ['name' => 'Ginecología y Obstetricia', 'description' => 'Salud del sistema reproductor femenino y embarazo.'],
            ['name' => 'Oftalmología', 'description' => 'Salud ocular y tratamiento de enfermedades de los ojos.'],
            ['name' => 'Traumatología y Ortopedia', 'description' => 'Lesiones del sistema musculoesquelético.'],
            ['name' => 'Neurología', 'description' => 'Trastornos del sistema nervioso central y periférico.'],
            ['name' => 'Medicina Interna', 'description' => 'Atención integral de enfermedades en adultos.'],
        ];

        foreach ($specialties as $specialty) {
            Specialty::updateOrCreate(['name' => $specialty['name']], $specialty);
        }
    }
}
