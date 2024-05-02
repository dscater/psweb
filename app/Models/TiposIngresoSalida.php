<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposIngresoSalida extends Model
{
    protected $fillable = [
        'nom','descripcion'
    ];

    protected $table = 'tipo_ingreso_salida';

    public function ingresos()
    {
        return $this->hasMany('App\Models\Ingreso','tipo_nom','nom');
    }

    public function salidas()
    {
        return $this->hasMany('App\Models\Salida','tipo_nom','nom');
    }
}
