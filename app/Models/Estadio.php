<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estadio extends Model
{
    protected $table = 'estadios';

    protected $fillable = [
        'nombre',
        'ciudad',
        'direccion',
        'capacidad',
        'estado',
    ];

    public function zonas()
    {
        return $this->hasMany(Zona::class, 'estadio_id');
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class, 'estadio_id');
    }
}