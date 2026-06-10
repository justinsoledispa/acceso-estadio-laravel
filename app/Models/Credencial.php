<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credencial extends Model
{
    protected $table = 'credenciales';

    protected $fillable = [
        'user_id',
        'tipo_acreditacion_id',
        'partido_id',
        'codigo_credencial',
        'fecha_emision',
        'fecha_vencimiento',
        'estado',
    ];
    protected $casts = [
    'fecha_emision' => 'date',
    'fecha_vencimiento' => 'date',
];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tipoAcreditacion()
    {
        return $this->belongsTo(TipoAcreditacion::class, 'tipo_acreditacion_id');
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partido_id');
    }

    public function registrosIntento()
    {
        return $this->hasMany(RegistroIntento::class, 'credencial_id');
    }
}