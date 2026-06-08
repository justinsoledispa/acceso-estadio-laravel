<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        Rol::create([
            'nombre' => 'Administrador',
            'descripcion' => 'Configura estadios, zonas, partidos y reportes.',
        ]);

        Rol::create([
            'nombre' => 'Operador de acreditación',
            'descripcion' => 'Registra usuarios y emite credenciales.',
        ]);

        Rol::create([
            'nombre' => 'Usuario final',
            'descripcion' => 'Consulta su credencial y simula ingresos.',
        ]);
    }
}