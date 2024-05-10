<?php

namespace App\Http\Controllers;

use App\Models\CapacitacionSeguridad;
use Illuminate\Http\Request;

class CapacitacionSeguridadController extends Controller
{
    public function index()
    {
        $capacitacion_seguridads = CapacitacionSeguridad::orderBy("total_registros", "desc")->get();

        return view("capacitacion_seguridads.index", compact("capacitacion_seguridads"));
    }
}
