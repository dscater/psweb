<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'pago_total','pago_venta','fecha','num_factura',
        'codigo','codigo_qr','observacion','estado',
        'fecha_venta','fecha_lim_emi','users_id','cliente_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','users_id','id');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente','cliente_id','id');
    }

    public function detalle_ventas()
    {
        return $this->hasMany('App\Models\DetalleVenta','venta_id','id');
    }
}
