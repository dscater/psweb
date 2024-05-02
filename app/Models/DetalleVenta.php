<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $fillable = [
        'cantidad','precio_uni','subtotal','precio_final',
        'descuento_sim','venta_id','producto_id'
    ];

    public function venta()
    {
        return $this->belongsTo('App\Models\Venta','venta_id','id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto','producto_id','id');
    }

    public function descuento()
    {
        return $this->belongsTo('App\Models\Descuento','descuento_sim','simbolo');
    }
}
