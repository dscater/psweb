<?php

namespace App\Http\Controllers;

use App\Models\AccionUser;
use App\Models\NotificacionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $res = Auth::attempt(["name" => $request->name, "password" => $request->password, "status" => 1]);
        if ($res) {
            return redirect()->route("home");
        }

        

        return redirect()->back()->withErrors([
            "name" => "El usuario o contraseña son incorrectos"
        ])->withInput(["name" => $request->name]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route("inicio_app");
    }


    public static function envioNotificaciones()
    {

        $users = User::where("id", "!=", 1)->where("status", 1)->get();

        foreach ($users as $item) {
            // contraseñas
            if ($item->c_password == 'DEBIL' || $item->c_password == 'RENOVAR') {
                $descripcion = "POR SEGURIDAD DEL SISTEMA DEBE FORTALECER SU CONTRASEÑA CON EL USO DE CARACTERES Y NÚMEROS";
                if ($item->c_password == 'RENOVAR') {
                    $descripcion = "POR SEGURIDAD DEL SISTEMA DEBE RENOVAR SU CONTRASEÑA CON EL USO DE CARACTERES Y NÚMEROS";
                }
                NotificacionUser::registraNotificacion($item, $descripcion);
            }

            // AUTORIZACION ADECUADA
            // verificacion modulos
            $accion_users = AccionUser::where("user_id", $item->id)->get();
            foreach ($accion_users as $au) {
                $total_crear = $au->crear;
                $total_editar = $au->editar;
                $total_eliminar = $au->eliminar;
                if ($total_editar >= (int)($total_crear / 2)) {
                    $descripcion = "POR SEGURIDAD DEL SISTEMA DEBE EVITAR EDITAR EN GRAN CANTIDAD LOS REGISTROS DEL SISTEMA, LE RECOMENDAMOS TOMAR EL CURSO DE CAPACITCACIÓN DEL SISTEMA PARA UNMEJOR MANEJO Y COMPRENSIÓN";
                }
                if ($total_eliminar >= (int)($total_crear / 2)) {
                    $descripcion = "POR SEGURIDAD DEL SISTEMA DEBE EVITAR ELIMINAR EN GRAN CANTIDAD LOS REGISTROS DEL SISTEMA, LE RECOMENDAMOS TOMAR EL CURSO DE CAPACITCACIÓN DEL SISTEMA PARA UNMEJOR MANEJO Y COMPRENSIÓN";
                }
            }
        }
    }
}
