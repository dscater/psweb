<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoRfid extends Model
{
    protected $fillable = [
        'rfid','producto_id','estado'
    ];

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto','producto_id','id');
    }
}
