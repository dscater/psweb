<?php

namespace App\Http\Controllers;

use App\Models\AccionUser;
use App\Models\AlertaNotificacion;
use App\Models\AutenticacionSegura;
use App\Models\AutorizacionAdecuada;
use App\Models\CapacitacionSeguridad;
use App\Models\EscanoVulnerabilidad;
use App\Models\NotificacionUser;
use App\Models\Respaldo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $res = Auth::attempt(["name" => $request->name, "password" => $request->password, "status" => 1]);
        if ($res) {
            self::envioNotificaciones();

            $respaldo = new Respaldo();
            $respaldo->crearBackup();

            return redirect()->route("home");
        }

        return redirect()->back()->withErrors([
            "name" => "El usuario o contraseña son incorrectos"
        ])->withInput(["name" => $request->name]);
    }

    public function logout(Request $request)
    {
        if (isset($request->inactividad) && $request->inactividad && Auth::user()->id != 1) {
            if (Auth::user()->tipo != 'SUPERVISOR DE CALIDAD') {
                EscanoVulnerabilidad::create([
                    "user_id" => Auth::user()->id,
                    "enviado" => 0,
                ]);
            }
        }

        Auth::logout();
        $respaldo = new Respaldo();
        $respaldo->crearBackup();

        if ($request->ajax()) {
            return response()->JSON(true);
        }

        return redirect()->route("inicio_app");
    }


    public static function envioNotificaciones()
    {

        $users = User::where("id", "!=", 1)->where("status", 1)->where("tipo", "!=", "SUPERVISOR DE CALIDAD")->get();

        CapacitacionSeguridad::generarUsuarios(); // CAPACITACION EN SEGURIDAD
        foreach ($users as $item) {
            // AUTENTICACIÓN SEGURA
            AutenticacionSegura::generarRegistros($item);
            $autenticacion_seguras = AutenticacionSegura::where("user_id", $item->id)->where("enviado", 0)->get();
            foreach ($autenticacion_seguras as $as) {
                $descripcion = "";
                if ($as->descripcion == 'DEBIL') {
                    $descripcion = "POR SEGURIDAD DEL SISTEMA DEBE FORTALECER SU CONTRASEÑA CON EL USO DE CARACTERES Y NÚMEROS";
                }
                if ($as->descripcion == 'RENOVAR') {
                    $descripcion = "POR SEGURIDAD DEL SISTEMA DEBE RENOVAR SU CONTRASEÑA CON EL USO DE CARACTERES Y NÚMEROS";
                }
                NotificacionUser::registraNotificacion($item, $descripcion, 'AUTENTICACIÓN SEGURA');
                $as->enviado = 1;
                $as->save();
            }

            // AUTORIZACIÓN ADECUADA
            AutorizacionAdecuada::generarRegistros($item);
            $autorizacion_adecuadas = AutorizacionAdecuada::where("user_id", $item->id)->where("enviado", 0)->get();
            foreach ($autorizacion_adecuadas as $au) {
                $descripcion = "";
                if ($au->editar > 0) {
                    $descripcion = "POR SEGURIDAD DEL SISTEMA DEBE EVITAR EDITAR EN GRAN CANTIDAD LOS REGISTROS DEL SISTEMA, LE RECOMENDAMOS TOMAR EL CURSO DE CAPACITCACIÓN DEL SISTEMA PARA UNMEJOR MANEJO Y COMPRENSIÓN";
                }
                if ($au->eliminar > 0) {
                    $descripcion = "POR SEGURIDAD DEL SISTEMA DEBE EVITAR ELIMINAR EN GRAN CANTIDAD LOS REGISTROS DEL SISTEMA, LE RECOMENDAMOS TOMAR EL CURSO DE CAPACITCACIÓN DEL SISTEMA PARA UNMEJOR MANEJO Y COMPRENSIÓN";
                }
                NotificacionUser::registraNotificacion($item, $descripcion, 'AUTORIZACIÓN ADECUADA');
                $au->enviado = 1;
                $au->save();
            }

            // ALERTAS Y NOTIFICACIONES
            $alerta_notificacions = AlertaNotificacion::where("user_id", $item->id)->where("enviado", 0)->get();
            foreach ($alerta_notificacions as $an) {
                $descripcion = "POR SEGURIDAD DEL SISTEMA LE NOTIFICAMOS QUE SU CUENTA HA RECIBIDO VARIOS INTENTOS DE ACCESOS, LE RECOMENDAMOS ACTUALIZAR SU CONTRASEÑA";
                NotificacionUser::registraNotificacion($item, $descripcion, 'ALERTAS Y NOTIFICACIONES');
                $an->enviado = 1;
                $an->save();
            }

            // ESCANEO DE VULNERABILIDADES
            $escaneo_vulnerabilidades = EscanoVulnerabilidad::where("user_id", $item->id)->where("enviado", 0)->get();
            foreach ($escaneo_vulnerabilidades as $ev) {
                $descripcion = "POR SEGURIDAD DEL SISTEMA LE RECOMENDAMOS CERRAR SESIÓN EN CASO DE NO UTILIZAR EL SISTEMA";
                NotificacionUser::registraNotificacion($item, $descripcion, 'ESCANEO DE VULNERABILIDADES');
                $ev->enviado = 1;
                $ev->save();
            }

            // CAPACITACIÓN EN SEGURIDAD
            $capacitacion_seguridads = CapacitacionSeguridad::where("user_id", $item->id)->where("enviado", 0)->get();
            foreach ($capacitacion_seguridads as $cs) {
                $descripcion = "POR SEGURIDAD DEL SISTEMA LE RECOMENDAMOS TOMAR EL CURSO DE CAPACITACIÓN DEL SISTEMA PARA UN MEJOR MANEJO Y COMPRENSIÓN";
                NotificacionUser::registraNotificacion($item, $descripcion, 'CAPACITACIÓN EN SEGURIDAD');
                $cs->total_registros = (int)$cs->total_registros + 1;
                $cs->enviado = 1;
                $cs->save();
            }
        }
    }
}
