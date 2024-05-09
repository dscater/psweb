<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccionUser extends Model
{
    use HasFactory;

    protected $fillable = [
        "modulo_id",
        "user_id",
        "crear",
        "editar",
        "eliminar",
    ];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // FUNCIONES
    public static function registrarAccion($url_modulo, $accion)
    {
        $user = Auth::user();
        if ($user) {
            $existe_acciones = AccionUser::where("user_id", $user->id)->get();

            if (count($existe_acciones) == 0) {
                self::inicializaAcciones($user);
            }

            $modulo = Modulo::where("url", $url_modulo)->get()->first();

            $accion_user = AccionUser::where("modulo_id", $modulo->id)->where("user_id", $user->id)->get()->first();
            if (!$accion_user) {
                $accion_user =  AccionUser::create([
                    "modulo_id" => $modulo->id,
                    "user_id" => $user->id,
                    "crear" => 0,
                    "editar" => 0,
                    "eliminar" => 0,
                ]);
            }

            $accion_user[$accion] = (int)$accion_user[$accion] + 1;
            $accion_user->save();
            return true;
        }
        return false;
    }

    public static function inicializaAcciones(User $user)
    {
        $modulos = Modulo::getMenuUsuario($user);
        foreach ($modulos as $mod) {
            $accion_user = AccionUser::where("modulo_id", $mod->modulo_id)->where("user_id", $user->id)->get()->first();
            if (!$accion_user && $mod->modulo->url != 'reportes') {
                AccionUser::create([
                    "modulo_id" => $mod->modulo_id,
                    "user_id" => $user->id,
                    "crear" => 0,
                    "editar" => 0,
                    "eliminar" => 0,
                ]);
            }
        }

        return true;
    }
}
