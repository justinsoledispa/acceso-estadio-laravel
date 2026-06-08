<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntoAcceso extends Model
{
    protected $table = 'puntos_acceso';

    protected $fillable = [
        'zona_id',
        'nombre',
        'tipo',
        'ubicacion',
        'estado',
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }

    public function registrosIntento()
    {
        return $this->hasMany(RegistroIntento::class, 'punto_acceso_id');
    }
}