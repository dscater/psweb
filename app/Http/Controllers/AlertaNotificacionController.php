<?php

namespace App\Http\Controllers;

use App\Models\NotificacionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlertaNotificacionController extends Controller
{
    public function index()
    {
        $notificacion_users = NotificacionUser::where("tipo", "ALERTAS Y NOTIFICACIONES")->orderBy("created_at", "desc")->get();
        return view("alerta_notificacions.index", compact("notificacion_users"));
    }
}
