<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CapacitacionSeguridad extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "enviado",
        "total_registros",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // functiones
    public static function generarUsuarios()
    {
        $notificacion_users = DB::select("SELECT count(*) as total_notis, user_id FROM `notificacion_users` WHERE tipo in ('AUTENTICACIÓN SEGURA','AUTORIZACIÓN ADECUADA','ALERTAS Y NOTIFICACIONES','ESCANEO DE VULNERABILIDADES','CAPACITACIÓN EN SEGURIDAD','GESTIÓN DE USUARIOS Y ROLES') GROUP BY user_id ORDER BY total_notis desc LIMIT 3;");

        foreach ($notificacion_users as $nu) {
            $existe = CapacitacionSeguridad::where("user_id", $nu->user_id)->get()->first();
            if (!$existe) {
                CapacitacionSeguridad::create([
                    "user_id" => $nu->user_id,
                    "enviado" => 0,
                    "total_registros" => $nu->total_notis 
                ]);
            } else {
                if ((int)$nu->total_notis != $existe->total_registros) {
                    $existe->enviado = 0;
                    $existe->save();
                }
            }
        }
    }
}
