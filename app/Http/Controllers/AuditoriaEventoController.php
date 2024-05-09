<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccion;
use Illuminate\Http\Request;

class AuditoriaEventoController extends Controller
{
    public function index()
    {
        $historial_accions = HistorialAccion::orderBy("created_at", "desc")->get();

        return view("auditoria_eventos.index", compact("historial_accions"));
    }
}
