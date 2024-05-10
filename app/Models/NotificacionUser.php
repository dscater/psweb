<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacionUser extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "descripcion",
        "tipo",
        "visto",
        "fecha",
        "hora",
    ];

    protected $appends = ["fecha_hora"];

    public function getFechaHoraAttribute()
    {
        return date("d/m/Y H:i", strtotime($this->fecha . ' ' . $this->hora));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // funciones
    public static function registraNotificacion(User $user, $descripcion, $tipo = 'NOTIFICACION')
    {
        $notificacion_user = NotificacionUser::create([
            "user_id" => $user->id,
            "descripcion" => $descripcion,
            "tipo" => $tipo,
            "fecha" => date("Y-m-d"),
            "hora" => date("H:i:s")
        ]);
        return $notificacion_user;
    }
}
