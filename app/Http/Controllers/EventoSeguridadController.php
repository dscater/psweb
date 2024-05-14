<?php

namespace App\Http\Controllers;

use App\Models\NotificacionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoSeguridadController extends Controller
{
    public function index()
    {
        if (Auth::user()->tipo == 'SUPERVISOR DE CALIDAD') {
            return view("evento_seguridads.supervisor2");
        } else {
            return view("evento_seguridads.index");
        }
    }

    public function gestion_roles(Request $request)
    {
        $gestion_roles = [];
        $html = "";
        if (Auth::user()->tipo == 'SUPERVISOR DE CALIDAD') {
            $gestion_roles = NotificacionUser::where("tipo", "GESTIÓN DE USUARIOS Y ROLES")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.supervisor.gestion_roles", compact("gestion_roles"))->render();
        } else {
            $gestion_roles = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "GESTIÓN DE USUARIOS Y ROLES")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.user.gestion_roles", compact("gestion_roles"))->render();
        }

        return response()->JSON($html);
    }
    public function autenticacion_seguras(Request $request)
    {
        $autenticacion_seguras = [];
        $html = "";
        if (Auth::user()->tipo == 'SUPERVISOR DE CALIDAD') {
            $autenticacion_seguras = NotificacionUser::where("tipo", "AUTENTICACIÓN SEGURA")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.supervisor.autenticacion_seguras", compact("autenticacion_seguras"))->render();
        } else {
            $autenticacion_seguras = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "AUTENTICACIÓN SEGURA")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.user.autenticacion_seguras", compact("autenticacion_seguras"))->render();
        }
        return response()->JSON($html);
    }
    public function autorizacion_adecuadas(Request $request)
    {
        $autorizacion_adecuadas = [];
        $html = "";
        if (Auth::user()->tipo == 'SUPERVISOR DE CALIDAD') {
            $autorizacion_adecuadas = NotificacionUser::where("tipo", "AUTORIZACIÓN ADECUADA")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.supervisor.autorizacion_adecuadas", compact("autorizacion_adecuadas"))->render();
        } else {
            $autorizacion_adecuadas = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "AUTORIZACIÓN ADECUADA")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.user.autorizacion_adecuadas", compact("autorizacion_adecuadas"))->render();
        }

        return response()->JSON($html);
    }
    public function prevension_ataques(Request $request)
    {
        $prevension_ataques = [];
        $html = "";
        if (Auth::user()->tipo == 'SUPERVISOR DE CALIDAD') {
            $prevension_ataques = NotificacionUser::where("tipo", "PREVENCIÓN DE ATAQUES")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.supervisor.prevension_ataques", compact("prevension_ataques"))->render();
        } else {
            $prevension_ataques = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "PREVENCIÓN DE ATAQUES")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.user.prevension_ataques", compact("prevension_ataques"))->render();
        }

        return response()->JSON($html);
    }
    public function alertas_notificaciones(Request $request)
    {
        $gestion_roles = [];
        $html = "";
        if (Auth::user()->tipo == 'SUPERVISOR DE CALIDAD') {
            $alertas_notificaciones = NotificacionUser::where("tipo", "ALERTAS Y NOTIFICACIONES")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.supervisor.alertas_notificaciones", compact("alertas_notificaciones"))->render();
        } else {
            $alertas_notificaciones = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "ALERTAS Y NOTIFICACIONES")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.user.alertas_notificaciones", compact("alertas_notificaciones"))->render();
        }

        return response()->JSON($html);
    }
    public function escaneo_vulnerabilidades(Request $request)
    {
        $escaneo_vulnerabilidades = [];
        $html = "";
        if (Auth::user()->tipo == 'SUPERVISOR DE CALIDAD') {
            $escaneo_vulnerabilidades = NotificacionUser::where("tipo", "ESCANEO DE VULNERABILIDADES")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.supervisor.escaneo_vulnerabilidades", compact("escaneo_vulnerabilidades"))->render();
        } else {
            $escaneo_vulnerabilidades = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "ESCANEO DE VULNERABILIDADES")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.user.escaneo_vulnerabilidades", compact("escaneo_vulnerabilidades"))->render();
        }

        return response()->JSON($html);
    }
    public function capacitacion_seguridads(Request $request)
    {
        $capacitacion_seguridads = [];
        $html = "";
        if (Auth::user()->tipo == 'SUPERVISOR DE CALIDAD') {
            $capacitacion_seguridads = NotificacionUser::where("tipo", "CAPACITACIÓN EN SEGURIDAD")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.supervisor.capacitacion_seguridads", compact("capacitacion_seguridads"))->render();
        } else {
            $capacitacion_seguridads = NotificacionUser::where("user_id", Auth::user()->id)->where("tipo", "CAPACITACIÓN EN SEGURIDAD")->orderBy("created_at", "desc")->paginate(5);
            $html = view("evento_seguridads.parcial.user.capacitacion_seguridads", compact("capacitacion_seguridads"))->render();
        }

        return response()->JSON($html);
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
        if (Auth::user()->id == $notificacion_user->user->id) {
            $notificacion_user->visto = 1;
            $notificacion_user->save();
        }

        return view("evento_seguridads.show", compact("notificacion_user"));
    }
}
