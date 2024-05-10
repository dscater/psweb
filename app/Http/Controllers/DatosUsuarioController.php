<?php

namespace App\Http\Controllers;

use App\Models\AccionUser;
use App\Models\DatosUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Empresa;
use App\Models\HistorialAccion;
use App\Models\Modulo;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatosUsuarioController extends Controller
{
    public function index(Request $request)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR') {
            $usuarios = DatosUsuario::lista();
            if ($request->ajax()) {
                return response()->JSON(view('usuarios.parcial.lista', compact('usuarios'))->render());
            }
            return view('usuarios.index', compact('empresa', 'usuarios'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function create()
    {
        if (!Modulo::canMod("users", "crear")) {
            abort(401, "No tienes permiso para ver este modulo");
        }

        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR') {
            return view('usuarios.create', compact('empresa'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $ultimo_codigo = User::get()->last()->name;
            $codigo = '';
            if ($ultimo_codigo != 'admin') {
                $codigo = (int)(substr($ultimo_codigo, 1, strlen($ultimo_codigo)));
                $codigo++;
            } else {
                $codigo = "1001";
            }

            switch ($request->tipo) {
                case "ADMINISTRADOR":
                    $codigo = "1" . $codigo;
                    break;
                case "ALMACENERO":
                    $codigo = "2" . $codigo;
                    break;
                case "SUPERVISOR DE CALIDAD":
                    $codigo = "3" . $codigo;
                    break;
            }

            // CREANDO EL USUARIO
            $nuevo_usuario = new User();
            $nuevo_usuario->name = $codigo;
            $nuevo_usuario->password = Hash::make(trim($request->ci_u));
            $nuevo_usuario->txt = trim($request->ci_u);
            $nuevo_usuario->ultimo = date("Y-m-d");
            $nuevo_usuario->tipo = $request->tipo;
            $nuevo_usuario->foto = "user_default.png";
            $nuevo_usuario->status = 1;
            $nuevo_usuario->save();
            Modulo::getMenuUsuario($nuevo_usuario);
            AccionUser::inicializaAcciones($nuevo_usuario);

            // CREANDO LOS DATOS DEL USUARIO
            $datosUsuario = new DatosUsuario(array_map('mb_strtoupper', $request->except('foto_u')));
            //obtener el archivo
            $file_foto = $request->file('foto_u');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $codigo . str_replace(' ', '_', $datosUsuario->nom_u) . time() . $extension;
            $file_foto->move(public_path() . "/imgs/personal/", $nom_foto);
            //completar los campos foto y fecha registro del personal
            $datosUsuario->foto_u = $nom_foto;
            $datosUsuario->fecha_reg = date('Y-m-d');
            $nuevo_usuario->datosUsuario()->save($datosUsuario);

            $datos_original = HistorialAccion::getDetalleRegistro($datosUsuario, "datos_usuarios");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' REGISTRO UN USUARIO',
                'datos_original' => $datos_original,
                'modulo' => 'USUARIOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            // registrar accion usuario
            AccionUser::registrarAccion("users", "crear");

            DB::commit();
            return redirect()->route('users.edit', $datosUsuario->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return redirect()->back()->with('error', 'error');
        }
    }

    public function edit(DatosUsuario $datosUsuario)
    {
        if (!Modulo::canMod("users", "editar")) {
            abort(401, "No tienes permiso para ver este modulo");
        }

        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR') {
            return view('usuarios.edit', compact('empresa', 'datosUsuario'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function update(Request $request, DatosUsuario $datosUsuario)
    {
        DB::beginTransaction();
        try {
            $codigo = "";
            switch ($request->tipo) {
                case "ADMINISTRADOR":
                    $codigo = "1" . substr($datosUsuario->user->name, 1, strlen($datosUsuario->user->name));
                    break;
                case "ALMACENERO":
                    $codigo = "2" . substr($datosUsuario->user->name, 1, strlen($datosUsuario->user->name));
                    break;
                case "SUPERVISOR DE CALIDAD":
                    $codigo = "3" . substr($datosUsuario->user->name, 1, strlen($datosUsuario->user->name));
                    break;
            }
            if ($datosUsuario->tipo != $request->tipo) {
                $datosUsuario->user->user_modulos()->delete();
            }

            $datosUsuario->user->tipo = $request->tipo;
            $datosUsuario->user->name = $codigo;
            $datosUsuario->user->save();
            if ($datosUsuario->tipo != $request->tipo) {
                Modulo::getMenuUsuario($datosUsuario->user);
                AccionUser::inicializaAcciones($datosUsuario->user);
            }
            $datos_original = HistorialAccion::getDetalleRegistro($datosUsuario, "datos_usuarios");
            $datosUsuario->update(array_map('mb_strtoupper', $request->except('foto_u')));
            if ($request->hasFile('foto_u')) {
                // ELIMINAR FOTO ANTIGUA
                $foto_antigua = $datosUsuario->foto_u;
                \File::delete(public_path() . "/imgs/personal/" . $foto_antigua);
                // SUBIR NUEVA FOTO
                $file_foto = $request->file('foto_u');
                $extension = "." . $file_foto->getClientOriginalExtension();
                $nom_foto = $datosUsuario->user->name . str_replace(' ', '_', $datosUsuario->nom_u) . time() . $extension;
                $file_foto->move(public_path() . "/imgs/personal/", $nom_foto);
                $datosUsuario->foto_u = $nom_foto;
                $datosUsuario->save();
            }

            $datos_nuevo = HistorialAccion::getDetalleRegistro($datosUsuario, "datos_usuarios");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' MODIFICÓ UN USUARIO',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'USUARIOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
            // registrar accion usuario
            AccionUser::registrarAccion("users", "editar");
            DB::commit();
            return redirect()->route('users.edit', $datosUsuario->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return redirect()->back()->with('error', 'error');
        }
    }

    public function show(DatosUsuario $datosUsuario)
    {
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($user, "users");
            $user->status = 0;
            $user->save();
            $datos_nuevo = HistorialAccion::getDetalleRegistro($user, "users");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'ELIMINACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' ELIMINÓ UN USUARIO',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'USUARIOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            // registrar accion usuario
            AccionUser::registrarAccion("users", "eliminar");
            DB::commit();
            return response()->JSON([
                'msg' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->JSON([
                'msg' => 'error',
            ]);
        }
    }

    // FUNCIONES PARA CONFIGURAR LA CUENTA DEL USUARIO
    public function config_cuenta(User $user)
    {
        $empresa = Empresa::first();
        return view('usuarios.config', compact('empresa', 'user'));
    }

    public function cuenta_update(Request $request, User $user)
    {
        if ($request->oldPassword) {
            if (Hash::check($request->oldPassword, $user->password)) {
                if ($request->newPassword == $request->password_confirm) {
                    $user->password = Hash::make($request->newPassword);
                    $user->txt = $request->newPassword;
                    $user->ultimo = date("Y-m-d");
                    $user->save();
                    return redirect()->route('users.config', $user->id)->with('password', 'exito');
                } else {
                    return redirect()->route('users.config', $user->id)->with('contra_error', 'comfirm');
                }
            } else {
                return redirect()->route('users.config', $user->id)->with('contra_error', 'old_password');
            }
        }
    }

    public function cuenta_update_foto(Request $request, User $user)
    {
        if ($request->ajax()) {
            if ($request->hasFile('foto')) {
                $archivo_img = $request->file('foto');
                $extension = '.' . $archivo_img->getClientOriginalExtension();
                $codigo = $user->name;
                $path = public_path() . '/imgs/users/' . $user->foto;
                if ($user->foto != 'user_default.png') {
                    \File::delete($path);
                }
                // SUBIENDO FOTO AL SERVIDOR
                if ($user->datosUsuario) {
                    $name_foto = $codigo . $user->datosUsuario->nom_u . time() . $extension; //determinar el nombre de la imagen y su extesion
                } else {
                    $name_foto = $codigo . time() . $extension; //determinar el nombre de la imagen y su extesion
                }
                $name_foto = str_replace(' ', '_', $name_foto);
                $archivo_img->move(public_path() . '/imgs/users/', $name_foto); //mover el archivo a la carpeta de destino

                $user->foto = $name_foto;
                $user->save();

                return response()->JSON([
                    'msg' => 'actualizado'
                ]);
            }
        }
    }

    private function subirImgsUpdate($file_img, $nom_img, $tipo)
    {
    }
}
