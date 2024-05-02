<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = [
        'nom','descripcion'
    ];

    public function productos()
    {
        return $this->hasMany('App\Models\Producto','marca_id','id');
    }
}
