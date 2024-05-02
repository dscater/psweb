<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $fillable = [
        'tipo_nom','producto_id','user_id',
        'precio_uni','cantidad','descripcion','fecha_salida'
    ];

    public function tipo_ingreso()
    {
        return $this->belongsTo('App\Models\TiposIngresoSalida','tipo_nom','nom');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto','producto_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
