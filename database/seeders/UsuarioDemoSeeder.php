<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioDemoSeeder extends Seeder
{
    public function run(): void
    {
        $adminRolId = DB::table('roles')->where('nombre', 'Administrador')->value('id');
        $operadorRolId = DB::table('roles')->where('nombre', 'Operador de acreditación')->value('id');
        $usuarioRolId = DB::table('roles')->where('nombre', 'Usuario final')->value('id');

        DB::table('users')->insert([
            [
                'role_id' => $adminRolId,
                'name' => 'Justin',
                'apellido' => 'Administrador',
                'email' => 'admin@test.com',
                'password' => Hash::make('12345678'),
                'documento' => 'ADMIN001',
                'telefono' => '0999999999',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => $operadorRolId,
                'name' => 'Xavier',
                'apellido' => 'Operador',
                'email' => 'operador@test.com',
                'password' => Hash::make('12345678'),
                'documento' => 'OPER001',
                'telefono' => '0988888888',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => $usuarioRolId,
                'name' => 'Ana',
                'apellido' => 'Torres',
                'email' => 'usuario@test.com',
                'password' => Hash::make('12345678'),
                'documento' => 'USER001',
                'telefono' => '0977777777',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}