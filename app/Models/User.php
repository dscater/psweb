<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password','tipo','foto','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* =================================================== 
                            RELACIONES
    ====================================================== */
    public function datosUsuario()
    {
        return $this->hasOne('App\Models\DatosUsuario','user_id','id');
    }

    public function proveedores()
    {
        return $this->hasMany('App\Models\Proveedor','user_id','id');
    }

    public function productos()
    {
        return $this->hasMany('App\Models\Producto','user_id','id');
    }

    public function clientes()
    {
        return $this->hasMany('App\Models\Cliente','user_id','id');
    }

    public function ventas()
    {
        return $this->hasMany('App\Models\Venta','users_id','id');
    }

    public function ingresos()
    {
        return $this->hasMany('App\Models\Ingreso','user_id','id');
    }

    public function salidas()
    {
        return $this->hasMany('App\Models\Salida','user_id','id');
    }
}
