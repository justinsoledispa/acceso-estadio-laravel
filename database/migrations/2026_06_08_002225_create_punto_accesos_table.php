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
    Schema::create('puntos_acceso', function (Blueprint $table) {
        $table->id();
        $table->foreignId('zona_id')->constrained('zonas');
        $table->string('nombre', 100);
        $table->string('tipo', 50)->nullable();
        $table->string('ubicacion', 150)->nullable();
        $table->string('estado', 20)->default('activo');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('puntos_acceso');
}
};
