<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = [
        "titulo",
        "url",
        "icon",
        "slug",
    ];

    public function user_modulos()
    {
        return $this->hasMany(UserModulo::class, 'modulo_id');
    }

    public static function getMenuUsuario(User $user)
    {
        $tiene_modulos = UserModulo::where("user_id", $user->id)->get();
        if (count($tiene_modulos) == 0) {

            // registrar los modulos del usuario
            $modulos_tipo = User::getModulosByTipo($user->tipo);
            foreach ($modulos_tipo as $value) {
                UserModulo::create([
                    "user_id" => $user->id,
                    "modulo_id" => $value,
                    "listar" => 1,
                    "crear" => 1,
                    "editar" => 1,
                    "eliminar" => 1,
                ]);
            }
            $tiene_modulos = UserModulo::where("user_id", $user->id)->get();
        }

        $modulos = $tiene_modulos;
        return $modulos;
    }

    public static function canMod($url, $accion)
    {
        $user = Auth::user();
        $modulo = Modulo::where("url", $url)->get()->first();
        if ($modulo && $user) {
            $user_modulo = UserModulo::where("user_id", $user->id)->where("modulo_id", $modulo->id)->get()->first();
            if ($user_modulo) {
                if ($user_modulo[$accion] == 1) {
                    return true;
                }
            }
        }

        return false;
    }
}
