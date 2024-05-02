<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $fillable = [
        'nom','descripcion',
    ];

    public function productos()
    {
        return $this->hasMany('App\Models\Producto','tipo_id','id');
    }
}
