<?php

namespace App\Http\Controllers;

use App\Models\NotificacionUser;
use App\Models\User;
use Illuminate\Http\Request;

class AutenticacionSeguraController extends Controller
{
    public function index()
    {
        $users = User::where("id", "!=", 1)->whereIn("tipo", ["ADMINISTRADOR", "ALMACENERO"])->where("status", 1)->get();
        return view("autenticacion_segura.index", compact("users"));
    }

    public function notificacion(User $user)
    {
        $descripcion = "";
        if ($user->c_password == 'DEBIL') {
            $descripcion = "POR SEGURIDAD DEL SISTEMA DEBE FORTALECER SU CONTRASEÑA CON EL USO DE CARACTERES Y NÚMEROS";
        }
        if ($user->c_password == 'RENOVAR') {
            $descripcion = "POR SEGURIDAD DEL SISTEMA DEBE RENOVAR SU CONTRASEÑA CON EL USO DE CARACTERES Y NÚMEROS";
        }
        NotificacionUser::registraNotificacion($user, $descripcion, 'AUTENTICACIÓN SEGURA');

        return redirect()->back()->with("success", "Notiticación enviada");
    }
}
