<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MedidaUpdateRequest;
use App\Http\Requests\MedidaStoreRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Medida;
use App\Models\Producto;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;

class MedidaController extends Controller
{
    public function index(Request $request)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            $medidas = Medida::all();
            if ($request->ajax()) {
                return response()->JSON(view('medidas.parcial.lista', compact('medidas'))->render());
            }
            return view('medidas.index', compact('empresa', 'medidas'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function create()
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('medidas.create', compact('empresa'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function store(MedidaStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $medida = Medida::create(array_map('mb_strtoupper', $request->all()));
            $datos_original = HistorialAccion::getDetalleRegistro($medida, "medidas");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' REGISTRO UNA MEDIDA',
                'datos_original' => $datos_original,
                'modulo' => 'MEDIDAS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
            DB::commit();
            return redirect()->route('medidas.edit', $medida->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->bac()->with('error', 'error');
        }
    }

    public function edit(Medida $medida)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('medidas.edit', compact('empresa', 'medida'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function update(MedidaUpdateRequest $request, Medida $medida)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($medida, "medidas");
            $medida->update(array_map('mb_strtoupper', $request->except('logo_p')));
            $datos_nuevo = HistorialAccion::getDetalleRegistro($medida, "medidas");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' MODIFICÓ UNA MEDIDA',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'MEDIDAS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
            DB::commit();
            return redirect()->route('medidas.edit', $medida->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'error');
        }
    }

    public function show(Medida $medida)
    {
    }

    public function destroy(Medida $medida)
    {
        DB::beginTransaction();
        try {
            $existe_uso = Producto::where('medida', '=', $medida->simbolo)->get();
            if (count($existe_uso) == 0) {
                $datos_original = HistorialAccion::getDetalleRegistro($medida, "medidas");
                $medida->delete();
                HistorialAccion::create([
                    'user_id' => Auth::user()->id,
                    'accion' => 'MODIFICACIÓN',
                    'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' ELIMINÓ UNA MEDIDA',
                    'datos_original' => $datos_original,
                    'modulo' => 'MEDIDAS',
                    'fecha' => date('Y-m-d'),
                    'hora' => date('H:i:s')
                ]);
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
