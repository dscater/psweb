<?php

namespace App\Models;

use DateTime;
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
        'name', 'password', 'txt', 'ultimo', 'tipo', 'foto', 'status'
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

    protected $appends = ["full_name", "full_ci", "c_password"];

    public function getFullNameAttribute()
    {
        if ($this->datosUsuario) {
            return $this->datosUsuario->nom_u . ' ' . $this->datosUsuario->apep_u . ($this->datosUsuario->apem_u ? ' ' . $this->datosUsuario->apem_u : '');
        }

        return $this->name;
    }

    public function getFullCiAttribute()
    {
        if ($this->datosUsuario) {
            return $this->datosUsuario->ci_u . ' ' . $this->datosUsuario->ci_exp_u;
        }

        return "";
    }

    public function getCPasswordAttribute()
    {
        $medicion = 4;
        $contrasena = $this->txt;
        // Longitud mínima
        if (strlen($contrasena) < 8) {
            $medicion--;
        }

        // Contiene caracteres especiales
        if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $contrasena)) {
            $medicion--;
        }

        // Contiene números
        if (!preg_match('/[0-9]/', $contrasena)) {
            $medicion--;
        }

        // Contiene letras mayúsculas y minúsculas
        if (!preg_match('/[A-Z]/', $contrasena) || !preg_match('/[a-z]/', $contrasena)) {
            $medicion--;
        }

        // Log::debug("===========");
        // Log::debug($this->id);
        // Log::debug($medicion);
        // Log::debug("=*****************");

        $estado = "FUERTE";
        if ($medicion <= 2) {
            $estado = "DEBIL";
        } elseif ($medicion < 4) {
            $estado = "BUENA";
        }

        // VALIDAR RENOVACIÓN
        $finicio = new DateTime($this->ultimo);
        $ffin = new DateTime(date("Y-m-d"));
        $diferencia = $finicio->diff($ffin);
        $mesesDiferencia = ($diferencia->y * 12) + $diferencia->m;
        if ($mesesDiferencia > 6) {
            return "RENOVAR";
        }

        return $estado;
    }


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
                7, //Ingresos
                8, //Salidas
                9, //Tipo Ingresos/Salidas
                10, //Reportes
            ],
            "ALMACENERO" => [
                2, //Pymes
                3, //Productos
                4, //Tipos
                5, //Marcas
                6, //Medidas
                7, //Ingresos
                8, //Salidas
                9, //Tipo Ingresos/Salidas
                10, //Reportes
            ],
            "SUPERVISOR DE CALIDAD" => [
                11, //Usuarios y ROles
                12, //Autentiación Segura
                13, //Autorización Adecuada
                14, //Prevención de ataques
                15, // Auditoría y registros de eventos
                16, // Alertas y Notificaciones
                17, // Respaldo y Recuperación
                18, // Escaneo de vulnerabilidades
                19, // Capacitación en Seguridad
            ],
        ];

        return $array_modulos[$tipo];
    }
}
