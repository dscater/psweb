<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AutenticacionAdecuadaController extends Controller
{
    public function index()
    {
        $users = User::where("id", "!=", 1)->whereIn("tipo", ["ADMINISTRADOR", "ALMACENERO"])->where("status", 1)->get();
        return view("autenticacion_adecuadas.index", compact("users"));
    }
}
