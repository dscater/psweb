<?php

namespace App\Http\Controllers;

use App\Models\NotificacionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoSeguridadController extends Controller
{
    public function index()
    {
        $notificacion_users = NotificacionUser::where("user_id", Auth::user()->id)->orderBy("created_at", "desc")->paginate(10);
        if (Auth::user()->tipo == 'SUPERVISOR DE CALIDAD') {
            return view("evento_seguridads.supervisor", compact("notificacion_users"));
        }

        $gestion_roles = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "GESTIÓN DE USUARIOS Y ROLES")->orderBy("created_at", "desc")->get();
        $autenticacion_seguras = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "AUTENTICACIÓN SEGURA")->orderBy("created_at", "desc")->get();
        $autorizacion_adecuadas = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "AUTORIZACIÓN ADECUADA")->orderBy("created_at", "desc")->get();
        $prevension_ataques = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "PREVENCIÓN DE ATAQUES")->orderBy("created_at", "desc")->get();
        $alertas_notificaciones = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "ALERTAS Y NOTIFICACIONES")->orderBy("created_at", "desc")->get();
        $escaneo_vulnerabilidades = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "ESCANEO DE VULNERABILIDADES")->orderBy("created_at", "desc")->get();
        $capacitacion_seguridads = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "CAPACITACIÓN EN SEGURIDAD")->orderBy("created_at", "desc")->get();

        return view("evento_seguridads.index", compact(
            "gestion_roles",
            "autenticacion_seguras",
            "autorizacion_adecuadas",
            "prevension_ataques",
            "alertas_notificaciones",
            "escaneo_vulnerabilidades",
            "capacitacion_seguridads"
        ));
    }

    public function byUser(Request $request)
    {
        $user = Auth::user();
        $id_actual = $request->id_actual;
        $ultimo_id = $id_actual;
        $notificacion_users = NotificacionUser::where("user_id", $user->id)->where("id", ">", $id_actual)->orderBy("created_at", "desc")->get();
        $sin_ver = NotificacionUser::where("user_id", $user->id)->where("visto", 0)->count();

        $html = view("parcial.notificacions", compact("notificacion_users"))->render();

        if (count($notificacion_users) > 0) {
            $ultimo_id = $notificacion_users[0]->id;
        }

        return response()->JSON([
            "ultimo_id" => $ultimo_id,
            "sin_ver" => $sin_ver,
            "html" => $html

        ]);
    }

    public function show(NotificacionUser $notificacion_user)
    {
        $notificacion_user->visto = 1;
        $notificacion_user->save();

        return view("evento_seguridads.show", compact("notificacion_user"));
    }
}
