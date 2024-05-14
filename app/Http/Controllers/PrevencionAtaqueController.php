<?php

namespace App\Http\Controllers;

use App\Models\NotificacionUser;
use Illuminate\Http\Request;

class PrevencionAtaqueController extends Controller
{
    public function index()
    {
        $notificacion_users = NotificacionUser::where("tipo", "PREVENCIÓN DE ATAQUES")->orderBy("created_at", "desc")->get();
        return view("prevencion_ataques.index", compact("notificacion_users"));
    }
}
