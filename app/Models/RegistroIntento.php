<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroIntento extends Model
{
    protected $table = 'registro_intentos';

    protected $fillable = [
        'credencial_id',
        'partido_id',
        'punto_acceso_id',
        'fecha_hora',
        'resultado',
        'motivo_rechazo',
    ];
    protected $casts = [
    'fecha_hora' => 'datetime',
];

    public function credencial()
    {
        return $this->belongsTo(Credencial::class, 'credencial_id');
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partido_id');
    }

    public function puntoAcceso()
    {
        return $this->belongsTo(PuntoAcceso::class, 'punto_acceso_id');
    }
}