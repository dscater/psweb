<?php

namespace App\Http\Middleware;

use App\Models\AlertaNotificacion;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ThrottleLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $maxAttempts = 3, $decayMinutes = 5, $blockDuration = 300): Response
    {
        $key = 'login_attempts:' . $request->ip();
        if (Cache::has($key . ':blocked')) {
            return redirect()->back()->withErrors(['error' => 'Intento fallido de inicio de sesión. Acceso bloqueado durante 5 minutos']);
        }

        if (Cache::has($key)) {
            if (Cache::get($key) >= $maxAttempts) {
                Cache::add($key . ':blocked', true, now()->addMinutes($blockDuration));
                return redirect()->back()->withErrors(['error' => 'Intento fallido de inicio de sesión. Acceso bloqueado durante 5 minutos']);
            }
        }

        $response = $next($request);

        $existe_user = User::where("name", $request->name)->get()->first();
        if ($existe_user && !Auth::check()) {
            $attempts = Cache::has($key) ? Cache::get($key) + 1 : 1;
            Cache::put($key, $attempts, now()->addMinutes($decayMinutes));
            $intentos_resantes = (int)$maxAttempts - (int)$attempts;
            if ($intentos_resantes == 0) {
                Cache::add($key . ':blocked', true, now()->addMinutes($blockDuration));
                // CREAR NOTIFICACION
                $user = User::where("name", $request->name)->get()->first();
                if ($user) {
                    AlertaNotificacion::create([
                        "user_id" => $user->id,
                        "enviado" => 0
                    ]);
                }
                return redirect()->back()->withErrors(['error' => 'Intento fallido de inicio de sesión. Acceso bloqueado durante 5 minutos']);
            }
            return redirect()->back()->withErrors(['error' => $intentos_resantes . ' intentos restantes']);
        }

        if (Auth::check()) {
            Cache::forget($key);
            Cache::forget($key . ':blocked');
        }

        return $response;
    }
}
