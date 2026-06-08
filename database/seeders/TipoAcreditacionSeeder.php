<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoAcreditacion;

class TipoAcreditacionSeeder extends Seeder
{
    public function run(): void
    {
        TipoAcreditacion::create([
            'nombre' => 'Hincha',
            'descripcion' => 'Acceso a zonas generales del estadio.',
        ]);

        TipoAcreditacion::create([
            'nombre' => 'Prensa',
            'descripcion' => 'Acceso a zonas de prensa y cobertura.',
        ]);

        TipoAcreditacion::create([
            'nombre' => 'Staff',
            'descripcion' => 'Acceso a zonas operativas del evento.',
        ]);

        TipoAcreditacion::create([
            'nombre' => 'Seguridad',
            'descripcion' => 'Acceso a zonas de control y seguridad.',
        ]);

        TipoAcreditacion::create([
            'nombre' => 'Proveedor',
            'descripcion' => 'Acceso a zonas logísticas o de servicio.',
        ]);
    }
}