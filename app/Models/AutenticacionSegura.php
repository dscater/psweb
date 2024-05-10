<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutenticacionSegura extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "descripcion",
        "enviado"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function generarRegistros(User $u)
    {
        if ($u->c_password == 'DEBIL' || $u->c_password == 'RENOVAR') {
            $existe = AutenticacionSegura::where("user_id", $u->id)->where("descripcion", $u->c_password)->get()->first();
            if (!$existe) {
                AutenticacionSegura::create([
                    "user_id" => $u->id,
                    "descripcion" => $u->c_password,
                    "enviado" => 0,
                ]);
            } else {
                if ($existe->created_at < date('Y-m-d')) {
                    $existe->enviado = 0;
                    $existe->save();
                }
            }
        }
    }
}
