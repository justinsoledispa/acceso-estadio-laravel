<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')
                ->nullable()
                ->after('id')
                ->constrained('roles');

            $table->string('apellido', 50)->nullable()->after('name');
            $table->string('documento', 10)->nullable()->after('email');
            $table->string('telefono', 20)->nullable()->after('documento');
            $table->string('estado', 20)->default('activo')->after('telefono');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);

            $table->dropColumn([
                'role_id',
                'apellido',
                'documento',
                'telefono',
                'estado',
            ]);
        });
    }
};