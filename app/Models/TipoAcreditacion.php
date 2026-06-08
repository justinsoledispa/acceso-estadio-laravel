<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAcreditacion extends Model
{
    protected $table = 'tipos_acreditacion';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function credenciales()
    {
        return $this->hasMany(Credencial::class, 'tipo_acreditacion_id');
    }

    public function zonas()
    {
        return $this->belongsToMany(Zona::class, 'tipo_acreditacion_zona', 'tipo_acreditacion_id', 'zona_id');
    }
}