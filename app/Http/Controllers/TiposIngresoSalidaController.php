<?php

namespace App\Http\Controllers;

use App\Models\AccionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\TiposIngresoSalida;
use App\Models\Producto;
use App\Models\Ingreso;
use App\Models\Salida;
use App\Models\Empresa;
use App\Models\HistorialAccion;
use Illuminate\Support\Facades\DB;

class TiposIngresoSalidaController extends Controller
{
    public function index(Request $request)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            $tipo_ingreso_salida = TiposIngresoSalida::all();
            if ($request->ajax()) {
                return response()->JSON(view('tipos_is.parcial.lista', compact('tipos_is'))->render());
            }
            return view('tipos_is.index', compact('empresa', 'tipo_ingreso_salida'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function create()
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('tipos_is.create', compact('empresa'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $tipo = TiposIngresoSalida::create(array_map('mb_strtoupper', $request->all()));
            $datos_original = HistorialAccion::getDetalleRegistro($tipo, "tipo_ingreso_salida");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' REGISTRO UN TIPO DE INGRESO/SALIDA',
                'datos_original' => $datos_original,
                'modulo' => 'TIPO DE INGRESO/SALIDA',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            // registrar accion usuario
            AccionUser::registrarAccion("tipo_ingreso_salida", "crear");

            DB::commit();
            return redirect()->route('tipo_ingreso_salida.edit', $tipo->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->bac()->with('error', 'error');
        }
    }

    public function edit(TiposIngresoSalida $tipo)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('tipos_is.edit', compact('empresa', 'tipo'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function update(Request $request, TiposIngresoSalida $tipo)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($tipo, "tipo_ingreso_salida");
            $tipo->update(array_map('mb_strtoupper', $request->except('logo_p')));
            $datos_nuevo = HistorialAccion::getDetalleRegistro($tipo, "tipo_ingreso_salida");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' MODIFICÓ UN TIPO DE INGRES/SALIDA',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'TIPO DE INGRES/SALIDA',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
            // registrar accion usuario
            AccionUser::registrarAccion("tipo_ingreso_salida", "editar");
            DB::commit();
            return redirect()->route('tipo_ingreso_salida.edit', $tipo->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'error');
        }
    }

    public function show(TiposIngresoSalida $tipo)
    {
    }

    public function destroy(TiposIngresoSalida $tipo)
    {
        DB::beginTransaction();
        try {
            $existe_uso = Ingreso::where('tipo_nom', '=', $tipo->nom)->get();
            if (count($existe_uso) == 0) {
                $existe_uso = Salida::where('tipo_nom', '=', $tipo->nom)->get();
                if (count($existe_uso) == 0) {
                    $datos_original = HistorialAccion::getDetalleRegistro($tipo, "tipo_ingreso_salida");
                    $tipo->delete();

                    HistorialAccion::create([
                        'user_id' => Auth::user()->id,
                        'accion' => 'MODIFICACIÓN',
                        'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' ELIMINÓ UN TIPO DE INGRESO/SALIDA',
                        'datos_original' => $datos_original,
                        'modulo' => 'TIPO DE INGRESO/SALIDA',
                        'fecha' => date('Y-m-d'),
                        'hora' => date('H:i:s')
                    ]);
                    // registrar accion usuario
                    AccionUser::registrarAccion("tipo_ingreso_salida", "eliminar");
                    DB::commit();
                    return response()->JSON([
                        'msg' => 'cambiar status',
                    ]);
                } else {
                    return response()->JSON([
                        'msg' => 'NO',
                    ]);
                }
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
