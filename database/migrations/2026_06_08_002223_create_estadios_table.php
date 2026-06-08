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
    Schema::create('estadios', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 100);
        $table->string('ciudad', 100);
        $table->string('direccion', 150)->nullable();
        $table->integer('capacidad')->nullable();
        $table->string('estado', 20)->default('activo');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('estadios');
}
};
