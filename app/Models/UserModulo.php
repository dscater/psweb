<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModulo extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "modulo_id",
        "listar",
        "crear",
        "editar",
        "eliminar",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }
}
