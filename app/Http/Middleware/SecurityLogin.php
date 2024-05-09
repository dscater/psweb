<?php

namespace App\Http\Middleware;

use App\Models\NotificacionUser;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SecurityLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cadena = $request->getUri() . " " . $request->name . " " . $request->password;
        $cadenas = ["where", "select", "*", "users", "user", "from", "db", "root"];

        $clientIp = $request->ip();
        $blockedIpKey = 'blocked_ip_' . $clientIp;

        if (Session::has($blockedIpKey)) {
            $blockTime = Session::get($blockedIpKey);
            if (time() - $blockTime >= 300) {
                Session::forget($blockedIpKey);
            } else {
                return redirect()->back()->withErrors(['error' => 'Acceso bloqueado durante 5 minutos']);
            }
        }

        foreach ($cadenas as $valor) {
            if (strpos($cadena, $valor) !== false) {
                Session::put($blockedIpKey, time());
                Session::save();
                // CREAR NOTIFICACION
                $user = User::where("name", $request->name)->get()->first();
                if ($user) {
                    $fecha = date("d/m/Y");
                    $hora = date("H:i:s");
                    $descripcion = "POR SEGURIDAD DEL SISTEMA LA CUENTA DEL USUARIO " . $user->full_name . " HA SIDO BLOQUEADO DURANTE 5 MINUTOS EN FECHA Y HORA " . $fecha . " " . $hora . " (PRESUNTO ATAQUE A LA CUENTA DE USUARIO)";
                    NotificacionUser::registraNotificacion($user, $descripcion);
                    $users_supervisor_calidad = User::where("tipo", "SUPERVISOR DE CALIDAD")->get();
                    foreach ($users_supervisor_calidad as $item) {
                        NotificacionUser::registraNotificacion($item, $descripcion);
                    }
                }
                return redirect()->back()->withErrors(['error' => 'Acceso bloqueado durante 5 minutos']);
            }
        }
        return $next($request);
    }
}
