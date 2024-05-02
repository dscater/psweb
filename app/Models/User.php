<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'tipo', 'foto', 'status'
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
        return $this->hasOne('App\Models\DatosUsuario', 'user_id', 'id');
    }

    public function proveedores()
    {
        return $this->hasMany('App\Models\Proveedor', 'user_id', 'id');
    }

    public function productos()
    {
        return $this->hasMany('App\Models\Producto', 'user_id', 'id');
    }

    public function clientes()
    {
        return $this->hasMany('App\Models\Cliente', 'user_id', 'id');
    }

    public function ventas()
    {
        return $this->hasMany('App\Models\Venta', 'users_id', 'id');
    }

    public function ingresos()
    {
        return $this->hasMany('App\Models\Ingreso', 'user_id', 'id');
    }

    public function salidas()
    {
        return $this->hasMany('App\Models\Salida', 'user_id', 'id');
    }

    public function user_modulos()
    {
        return $this->hasMany(UserModulo::class, 'user_id');
    }

    public function verificaPermiso($url, $accion)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $modulo = Modulo::where("url", $url)->get()->first();
            if ($modulo) {
                $user_modulo = UserModulo::where("user_id", $user->id)
                    ->where("modulo_id", $modulo->id)->get()->first();

                if ($user_modulo[$accion] == 1) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function getModulosByTipo($tipo)
    {
        $array_modulos = [
            "ADMINISTRADOR" => [
                1, //Usuarios
                2, //Pymes
                3, //Productos
                4, //Tipos
                5, //Marcas
                6, //Medidas
                7, //Reportes
            ],
            "ALMACENERO" => [
                2, //Pymes
                3, //Productos
                4, //Tipos
                5, //Marcas
                6, //Medidas
                7, //Reportes
            ],
            "SUPERVISOR DE CALIDAD" => [
                8, //Usuarios y ROles
                9, //Autentiación Segura
                10, //Autorización Adecuada
                11, //Prevención de ataques
                12, // Auditoría y registros de eventos
                13, // Alertas y Notificaciones
                14, // Respaldo y Recuperación
                15, // Escaneo de vulnerabilidades
                16, // Capacitación en Seguridad
            ],
        ];

        return $array_modulos[$tipo];
    }
}
