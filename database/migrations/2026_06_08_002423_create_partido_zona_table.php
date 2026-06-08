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
    Schema::create('partido_zona', function (Blueprint $table) {
        $table->id();
        $table->foreignId('partido_id')->constrained('partidos');
        $table->foreignId('zona_id')->constrained('zonas');
        $table->time('hora_apertura')->nullable();
        $table->time('hora_cierre')->nullable();
        $table->boolean('habilitada')->default(true);
        $table->timestamps();

        $table->unique(['partido_id', 'zona_id']);
    });
}

public function down(): void
{
    Schema::dropIfExists('partido_zona');
}
};
