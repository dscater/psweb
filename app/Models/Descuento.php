<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    protected $fillable = [
        'descuento','simbolo','descripcion'
    ];

    public function detalleVentas()
    {
        return $this->hasMany('App\Models\DetalleVenta','descuento_sim','simbolo');
    }
    
    public function detalle_ventas()
    {
        return $this->hasMany('App\Models\DetalleVenta','descuento_sim','simbolo');
    }
}
