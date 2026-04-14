<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// No necesitas importar User aquí si vas a usar el call()

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Primero creamos los roles
        $this->call(RoleSeeder::class);

        // 2. Luego llamamos al seeder de usuarios
        // Esto evita tener código repetido y errores de importación aquí
        $this->call(UserSeeder::class);
    }
}
