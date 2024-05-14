<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EscanoVulnerabilidadController extends Controller
{
    public function index()
    {
        $notificacion_users = NotificacionUser::where("tipo", "ESCANEO DE VULNERABILIDADES")->orderBy("created_at", "desc")->get();
        return view("escaneo_vulnerabilidads.index", compact("notificacion_users"));
    }
}
