<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
class Proveedor extends Model
{
    protected $fillable = [
        'razon_social_p','nit_pro_p','numa_pro_p','dir_dpto_p',
        'dir_ciudad_p','dir_zv_p','dir_ac_p','dir_nro_p',
        'fono_p','fono_alt_p','fax_p','email_p',
        'web_p','logo_p','nom_rep_p','apep_rep_p',
        'apem_rep_p','cel_rep_p','fecha_reg_p','user_id','status'
    ];

    public function productos()
    {
        return $this->hasMany('App\Models\Producto','proveedor_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function ingresos()
    {
        return $this->hasMany('App\Models\Ingreso','proveedor_id','id');
    }

    /* ========================================================================== 
                                    FUNCIONES
     ============================================================================ */
     public static function lista()
     {
         return DB::select("SELECT * FROM proveedors where status = 1");
     }
}
