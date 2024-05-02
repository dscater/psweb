<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'num_cli','nom_cli','nit_ci','user_id','status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function ventas()
    {
        return $this->hasMany('App\Models\Venta','cliente_id','id');
    }
}
