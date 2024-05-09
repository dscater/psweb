<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AutenticacionSeguraController extends Controller
{
    public function index()
    {
        $users = User::where("id", "!=", 1)->whereIn("tipo", ["ADMINISTRADOR", "ALMACENERO"])->where("status", 1)->get();
        return view("autenticacion_segura.index", compact("users"));
    }
}
