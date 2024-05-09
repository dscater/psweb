<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MarcaStoreRequest;
use App\Http\Requests\MarcaUpdateRequest;
use App\Models\AccionUser;
use Illuminate\Support\Facades\Auth;

use App\Models\Marca;
use App\Models\Producto;
use App\Models\Empresa;
use App\Models\HistorialAccion;
use Illuminate\Support\Facades\DB;

class MarcaController extends Controller
{
    public function index(Request $request)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            $marcas = Marca::all();
            if ($request->ajax()) {
                return response()->JSON(view('marcas.parcial.lista', compact('marcas'))->render());
            }
            return view('marcas.index', compact('empresa', 'marcas'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function create()
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('marcas.create', compact('empresa'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function store(MarcaStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $marca = Marca::create(array_map('mb_strtoupper', $request->all()));
            $datos_original = HistorialAccion::getDetalleRegistro($marca, "marcas");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' REGISTRO UNA MARCA',
                'datos_original' => $datos_original,
                'modulo' => 'MARCAS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
            // registrar accion usuario
            AccionUser::registrarAccion("marcas", "crear");
            DB::commit();
            return redirect()->route('marcas.edit', $marca->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->bac()->with('error', 'error');
        }
    }

    public function edit(Marca $marca)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('marcas.edit', compact('empresa', 'marca'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function update(MarcaUpdateRequest $request, Marca $marca)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($marca, "marcas");
            $marca->update(array_map('mb_strtoupper', $request->all()));
            $datos_nuevo = HistorialAccion::getDetalleRegistro($marca, "marcas");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' MODIFICÓ UNA MARCA',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'MARCAS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
            // registrar accion usuario
            AccionUser::registrarAccion("marcas", "editar");
            DB::commit();
            return redirect()->route('marcas.edit', $marca->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'error');
        }
    }

    public function show(Marca $marca)
    {
    }

    public function destroy(Marca $marca)
    {
        DB::beginTransaction();
        try {
            $existe_uso = Producto::where('marca', '=', $marca->nom)->get();
            if (count($existe_uso) == 0) {
                $datos_original = HistorialAccion::getDetalleRegistro($marca, "marcas");
                $marca->delete();
                HistorialAccion::create([
                    'user_id' => Auth::user()->id,
                    'accion' => 'MODIFICACIÓN',
                    'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' ELIMINÓ UNA MARCA',
                    'datos_original' => $datos_original,
                    'modulo' => 'MARCAS',
                    'fecha' => date('Y-m-d'),
                    'hora' => date('H:i:s')
                ]);
                // registrar accion usuario
                AccionUser::registrarAccion("marcas", "eliminar");
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
