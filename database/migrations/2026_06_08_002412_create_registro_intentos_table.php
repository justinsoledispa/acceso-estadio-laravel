<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('registro_intentos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('credencial_id')->constrained('credenciales');
        $table->foreignId('partido_id')->constrained('partidos');
        $table->foreignId('punto_acceso_id')->constrained('puntos_acceso');
        $table->dateTime('fecha_hora');
        $table->string('resultado', 20);
        $table->string('motivo_rechazo', 250)->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('registro_intentos');
}
};
