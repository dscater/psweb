<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TipoUpdateRequest;
use App\Http\Requests\TipoRequest;
use App\Models\AccionUser;
use Illuminate\Support\Facades\Auth;

use App\Models\Tipo;
use App\Models\Producto;
use App\Models\Empresa;
use App\Models\HistorialAccion;
use Illuminate\Support\Facades\DB;

class TipoController extends Controller
{
    public function index(Request $request)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            $tipos = Tipo::all();
            if ($request->ajax()) {
                return response()->JSON(view('tipos.parcial.lista', compact('tipos'))->render());
            }
            return view('tipos.index', compact('empresa', 'tipos'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function create()
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('tipos.create', compact('empresa'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function store(TipoRequest $request)
    {
        DB::beginTransaction();
        try {
            $tipo = Tipo::create(array_map('mb_strtoupper', $request->all()));
            $datos_original = HistorialAccion::getDetalleRegistro($tipo, "tipos");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' REGISTRO UN TIPO',
                'datos_original' => $datos_original,
                'modulo' => 'TIPOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
            // registrar accion usuario
            AccionUser::registrarAccion("tipos", "crear");
            DB::commit();
            return redirect()->route('tipos.edit', $tipo->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'error');
        }
    }

    public function edit(Tipo $tipo)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('tipos.edit', compact('empresa', 'tipo'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function update(TipoUpdateRequest $request, Tipo $tipo)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($tipo, "tipos");
            $tipo->update(array_map('mb_strtoupper', $request->except('logo_p')));
            $datos_nuevo = HistorialAccion::getDetalleRegistro($tipo, "tipos");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' MODIFICÓ UN TIPO',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'TIPOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
            // registrar accion usuario
            AccionUser::registrarAccion("tipos", "editar");
            DB::commit();
            return redirect()->route('tipos.edit', $tipo->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'error');
        }
    }

    public function show(Tipo $tipo)
    {
    }

    public function destroy(Tipo $tipo)
    {
        DB::beginTransaction();
        try {
            $existe_uso = Producto::where('tipo', '=', $tipo->nom)->get();
            if (count($existe_uso) == 0) {
                $datos_original = HistorialAccion::getDetalleRegistro($tipo, "tipos");
                $tipo->delete();

                HistorialAccion::create([
                    'user_id' => Auth::user()->id,
                    'accion' => 'MODIFICACIÓN',
                    'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' ELIMINÓ UN TIPO',
                    'datos_original' => $datos_original,
                    'modulo' => 'TIPOS',
                    'fecha' => date('Y-m-d'),
                    'hora' => date('H:i:s')
                ]);
                // registrar accion usuario
                AccionUser::registrarAccion("tipos", "eliminar");
                DB::commit();
                return response()->JSON([
                    'msg' => 'cambiar status',
                ]);
            } else {
                return response()->JSON([
                    'msg' => 'NO',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->JSON([
                'msg' => 'error',
            ]);
        }
    }
}
