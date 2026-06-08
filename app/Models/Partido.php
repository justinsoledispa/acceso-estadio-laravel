<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table = 'partidos';

    protected $fillable = [
        'estadio_id',
        'nombre',
        'fecha',
        'hora_inicio',
        'estado',
    ];

    public function estadio()
    {
        return $this->belongsTo(Estadio::class, 'estadio_id');
    }

    public function zonas()
    {
        return $this->belongsToMany(Zona::class, 'partido_zona', 'partido_id', 'zona_id');
    }

    public function credenciales()
    {
        return $this->hasMany(Credencial::class, 'partido_id');
    }

    public function registrosIntento()
    {
        return $this->hasMany(RegistroIntento::class, 'partido_id');
    }
}