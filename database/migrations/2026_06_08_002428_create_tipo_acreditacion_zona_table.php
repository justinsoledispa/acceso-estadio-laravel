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
    Schema::create('tipo_acreditacion_zona', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tipo_acreditacion_id')->constrained('tipos_acreditacion');
        $table->foreignId('zona_id')->constrained('zonas');
        $table->timestamps();

        $table->unique(['tipo_acreditacion_id', 'zona_id']);
    });
}

public function down(): void
{
    Schema::dropIfExists('tipo_acreditacion_zona');
}
};
