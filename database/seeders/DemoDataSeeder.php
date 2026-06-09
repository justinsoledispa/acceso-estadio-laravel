<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $estadioId = DB::table('estadios')->insertGetId([
            'nombre' => 'Estadio Monumental',
            'ciudad' => 'Guayaquil',
            'direccion' => 'Av. Barcelona',
            'capacidad' => 59000,
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $tribunaNorteId = DB::table('zonas')->insertGetId([
            'estadio_id' => $estadioId,
            'nombre' => 'Tribuna Norte',
            'tipo_zona' => 'general',
            'descripcion' => 'Zona general para hinchas.',
            'estado' => 'activa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $zonaPrensaId = DB::table('zonas')->insertGetId([
            'estadio_id' => $estadioId,
            'nombre' => 'Zona de Prensa',
            'tipo_zona' => 'prensa',
            'descripcion' => 'Área destinada a periodistas y medios.',
            'estado' => 'activa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $zonaMixtaId = DB::table('zonas')->insertGetId([
            'estadio_id' => $estadioId,
            'nombre' => 'Zona Mixta',
            'tipo_zona' => 'prensa',
            'descripcion' => 'Área de contacto entre prensa y delegaciones.',
            'estado' => 'activa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $camerinosId = DB::table('zonas')->insertGetId([
            'estadio_id' => $estadioId,
            'nombre' => 'Camerinos',
            'tipo_zona' => 'restringida',
            'descripcion' => 'Zona restringida para equipos y personal autorizado.',
            'estado' => 'activa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('puntos_acceso')->insert([
            [
                'zona_id' => $tribunaNorteId,
                'nombre' => 'Puerta Norte 1',
                'tipo' => 'puerta',
                'ubicacion' => 'Ingreso norte del estadio',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zona_id' => $zonaPrensaId,
                'nombre' => 'Acceso Prensa 1',
                'tipo' => 'control',
                'ubicacion' => 'Lateral oeste',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'zona_id' => $camerinosId,
                'nombre' => 'Acceso Camerinos 1',
                'tipo' => 'control',
                'ubicacion' => 'Zona interna restringida',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $partidoId = DB::table('partidos')->insertGetId([
            'estadio_id' => $estadioId,
            'nombre' => 'Ecuador vs Brasil',
            'fecha' => now()->toDateString(),
            'hora_inicio' => '15:00:00',
            'estado' => 'activo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('partido_zona')->insert([
            [
                'partido_id' => $partidoId,
                'zona_id' => $tribunaNorteId,
                'hora_apertura' => '12:00:00',
                'hora_cierre' => '20:00:00',
                'habilitada' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'partido_id' => $partidoId,
                'zona_id' => $zonaPrensaId,
                'hora_apertura' => '12:00:00',
                'hora_cierre' => '20:00:00',
                'habilitada' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'partido_id' => $partidoId,
                'zona_id' => $zonaMixtaId,
                'hora_apertura' => '12:00:00',
                'hora_cierre' => '20:00:00',
                'habilitada' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'partido_id' => $partidoId,
                'zona_id' => $camerinosId,
                'hora_apertura' => '12:00:00',
                'hora_cierre' => '20:00:00',
                'habilitada' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $hinchaId = DB::table('tipos_acreditacion')->where('nombre', 'Hincha')->value('id');
        $prensaId = DB::table('tipos_acreditacion')->where('nombre', 'Prensa')->value('id');
        $staffId = DB::table('tipos_acreditacion')->where('nombre', 'Staff')->value('id');
        $seguridadId = DB::table('tipos_acreditacion')->where('nombre', 'Seguridad')->value('id');

        DB::table('tipo_acreditacion_zona')->insert([
            [
                'tipo_acreditacion_id' => $hinchaId,
                'zona_id' => $tribunaNorteId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_acreditacion_id' => $prensaId,
                'zona_id' => $zonaPrensaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_acreditacion_id' => $prensaId,
                'zona_id' => $zonaMixtaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_acreditacion_id' => $staffId,
                'zona_id' => $zonaMixtaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_acreditacion_id' => $staffId,
                'zona_id' => $camerinosId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_acreditacion_id' => $seguridadId,
                'zona_id' => $tribunaNorteId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_acreditacion_id' => $seguridadId,
                'zona_id' => $zonaPrensaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_acreditacion_id' => $seguridadId,
                'zona_id' => $zonaMixtaId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_acreditacion_id' => $seguridadId,
                'zona_id' => $camerinosId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
    'tipo_acreditacion_id' => $staffId,
    'zona_id' => $zonaPrensaId,
    'created_at' => now(),
    'updated_at' => now(),
],
        ]);

        $usuarioFinalId = DB::table('users')->where('email', 'usuario@test.com')->value('id');

        DB::table('credenciales')->insert([
            'user_id' => $usuarioFinalId,
            'tipo_acreditacion_id' => $prensaId,
            'partido_id' => $partidoId,
            'codigo_credencial' => 'CRD-2026-00045',
            'fecha_emision' => now()->toDateString(),
            'fecha_vencimiento' => now()->addDays(1)->toDateString(),
            'estado' => 'activa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}