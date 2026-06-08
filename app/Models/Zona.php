<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table = 'zonas';

    protected $fillable = [
        'estadio_id',
        'nombre',
        'tipo_zona',
        'descripcion',
        'estado',
    ];

    public function estadio()
    {
        return $this->belongsTo(Estadio::class, 'estadio_id');
    }

    public function puntosAcceso()
    {
        return $this->hasMany(PuntoAcceso::class, 'zona_id');
    }

    public function partidos()
    {
        return $this->belongsToMany(Partido::class, 'partido_zona', 'zona_id', 'partido_id');
    }

    public function tiposAcreditacion()
    {
        return $this->belongsToMany(TipoAcreditacion::class, 'tipo_acreditacion_zona', 'zona_id', 'tipo_acreditacion_id');
    }
}