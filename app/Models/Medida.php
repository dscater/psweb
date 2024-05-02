<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    protected $fillable = [
        'nom','simbolo','descripcion'
    ];
    
    public function productos()
    {
        return $this->hasMany('App\Models\Producto','medida_id','id');
    }
}
