<?php

namespace App\Http\Controllers;

use App\Models\CapacitacionSeguridad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Empresa;
use App\Models\HistorialAccion;
use App\Models\Marca;
use App\Models\Medida;
use App\Models\NotificacionUser;
use App\Models\Producto;
use App\Models\User;
use App\Models\Proveedor;
use App\Models\Respaldo;
use App\Models\RespaldoDb;
use App\Models\Tipo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empresa = Empresa::first();
        $datos = [];
        if (Auth::user()->tipo == 'SUPERVISOR DE CALIDAD') {
            $notificacion_users = NotificacionUser::get();
            $usuarios = User::where("tipo", "!=", "SUPERVISOR DE CALIDAD")->where('status', '=', 1)->where("id", "!=", 1)->get();
            $autenticacion_seguras = NotificacionUser::where("tipo", "AUTENTICACIÓN SEGURA")->orderBy("created_at", "desc")->get();
            $autorizacion_adecuadas = NotificacionUser::where("tipo", "AUTORIZACIÓN ADECUADA")->orderBy("created_at", "desc")->get();
            $prevension_ataques = NotificacionUser::where("tipo", "PREVENCIÓN DE ATAQUES")->orderBy("created_at", "desc")->get();
            $historial_accions = HistorialAccion::all();
            $alertas_notificaciones = NotificacionUser::where("tipo", "ALERTAS Y NOTIFICACIONES")->orderBy("created_at", "desc")->paginate(5);
            $respaldo_db = RespaldoDb::all();
            $escaneo_vulnerabilidades = NotificacionUser::where("tipo", "ESCANEO DE VULNERABILIDADES")->orderBy("created_at", "desc")->paginate(5);
            $capacitacion_seguridads = CapacitacionSeguridad::orderBy("total_registros", "desc")->get();

            $datos = [
                'notificacion_users' => count($notificacion_users),
                'usuarios' => count($usuarios),
                'autenticacion_seguras' => count($autenticacion_seguras),
                'autorizacion_adecuadas' => count($autorizacion_adecuadas),
                'prevension_ataques' => count($prevension_ataques),
                'historial_accions' => count($historial_accions),
                'alertas_notificaciones' => count($alertas_notificaciones),
                'respaldo_db' => count($respaldo_db),
                'escaneo_vulnerabilidades' => count($escaneo_vulnerabilidades),
                'capacitacion_seguridads' => count($capacitacion_seguridads),
            ];
        } else {
            $productos = Producto::where('status', '=', 1)->get();
            $usuarios = User::where('status', '=', 1)->where("id", "!=", 1)->get();
            $proveedores = Proveedor::where('status', '=', 1)->get();
            $tipos = Tipo::all();
            $marcas = Marca::all();
            $medidas = Medida::all();
            $notificacion_users = NotificacionUser::where("user_id", Auth::user()->id)->get();
            $datos = [
                'productos' => count($productos),
                'usuarios' => count($usuarios),
                'proveedores' => count($proveedores),
                'tipos' => count($tipos),
                'marcas' => count($marcas),
                'medidas' => count($medidas),
                'notificacion_users' => count($notificacion_users),
            ];
        }
        return view('home', compact('empresa', 'datos'));
    }
}
