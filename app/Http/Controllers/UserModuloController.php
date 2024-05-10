<?php

namespace App\Http\Controllers;

use App\Models\NotificacionUser;
use App\Models\User;
use App\Models\UserModulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserModuloController extends Controller
{
    public function index()
    {
        $administradores = User::where("id", "!=", 1)->where("tipo", "ADMINISTRADOR")->where("status", 1)->get();
        $almaceneros = User::where("id", "!=", 1)->where("tipo", "ALMACENERO")->where("status", 1)->get();

        return view("user_modulos.index", compact("administradores", "almaceneros"));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }
    public function edit()
    {
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_modulo_id = $request->user_modulo_id;
            $valor = $request->valor;
            $col = $request->col;

            $user_modulo = UserModulo::find($user_modulo_id);
            $user_modulo[$col] = $valor;
            $user_modulo->save();

            // REGISTRAR NOTIFICACION
            $descripcion = "";
            $permiso = "CREACIÓN";
            if ($col == 'editar') {
                $permiso = "EDICIÓN";
            }
            if ($col == 'eliminar') {
                $permiso = "ELIMINACIÓN";
            }

            if ($valor == 0) {
                $descripcion = "POR SEGURIDAD DEL SISTEMA SE LE HA DESHABILITADO EL PERMISO DE " . $permiso . " DE " . mb_strtoupper($user_modulo->modulo->titulo);
            } else {
                $descripcion = "POR SEGURIDAD DEL SISTEMA SE LE HA HABILITADO EL PERMISO DE " . $permiso . " DE " . mb_strtoupper($user_modulo->modulo->titulo);
            }

            NotificacionUser::registraNotificacion($user_modulo->user, $descripcion, 'GESTIÓN DE USUARIOS Y ROLES');

            DB::commit();
            return response()->JSON([
                "message" => "Registro actualizado",
                "user_modulo" => $user_modulo
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->JSON([
                "message" => $e->getMessage(),
            ], 500);
        }
    }
    public function show()
    {
    }

    public function destroy()
    {
    }
}
