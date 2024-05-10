<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutorizacionAdecuada extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "modulo_id",
        "crear",
        "editar",
        "eliminar",
        "enviado",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    // funciones
    public static function generarRegistros(User $u)
    {
        $accion_users = AccionUser::where("user_id", $u->id)->get();

        foreach ($accion_users as $au) {
            $total_crear = $au->crear;
            $total_editar = $au->editar;
            $total_eliminar = $au->eliminar;
            if ($total_crear > 0 && $total_editar >= (int)($total_crear / 2)) {
                $existe = AutorizacionAdecuada::where("user_id", $u->id)
                    ->where("enviado", 0)
                    ->where("modulo_id", $au->modulo_id)
                    ->where("editar", ">", '0')
                    ->get()->first();
                if (!$existe) {
                    AutorizacionAdecuada::create([
                        "user_id" => $u->id,
                        "modulo_id" => $au->modulo_id,
                        "crear" => $au->crear,
                        "editar" => $au->editar,
                        "eliminar" => 0,
                        "enviado" => 0,
                    ]);
                } else {
                    if ($existe->crear != $au->crear || $existe->editar != $au->editar) {
                        $existe->enviado = 0;
                        $existe->save();
                    }
                }
            }
            if ($total_crear > 0 && $total_eliminar >= (int)($total_crear / 2)) {
                $existe = AutorizacionAdecuada::where("user_id", $u->id)
                    ->where("enviado", 0)
                    ->where("modulo_id", $au->modulo_id)
                    ->where("eliminar", ">", '0')
                    ->get()->first();
                if (!$existe) {
                    AutorizacionAdecuada::create([
                        "user_id" => $u->id,
                        "modulo_id" => $au->modulo_id,
                        "crear" => $au->crear,
                        "editar" => 0,
                        "eliminar" => $au->eliminar,
                        "enviado" => 0,
                    ]);
                } else {
                    if ($existe->crear != $au->crear || $existe->eliminar != $au->eliminar) {
                        $existe->enviado = 0;
                        $existe->save();
                    }
                }
            }
        }
        return true;
    }
}
