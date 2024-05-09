<?php

namespace App\Http\Controllers;

use App\Models\NotificacionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlertaNotificacionController extends Controller
{
    public function index()
    {
        $notificacion_users = NotificacionUser::where("user_id", Auth::user()->id)->get();
        return view("alerta_notificacions", compact("notificacion_users"));
    }
}
