<?php

namespace App\Http\Controllers;

use App\Models\AccionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Proveedor;
use App\Models\Empresa;
use App\Models\HistorialAccion;
use App\Models\Modulo;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            $proveedores = Proveedor::lista();
            if ($request->ajax()) {
                return response()->JSON(view('proveedores.parcial.lista', compact('proveedores'))->render());
            }
            return view('proveedores.index', compact('empresa', 'proveedores'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function create()
    {
        if (!Modulo::canMod("pymes", "crear")) {
            abort(401, "No tienes permiso para ver este modulo");
        }

        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('proveedores.create', compact('empresa'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $proveedor = new Proveedor(array_map('mb_strtoupper', $request->except('logo_p')));
            //SUBIR LOGO
            $logo = $request->file('logo_p');
            $extension = "." . $logo->getClientOriginalExtension();
            $nom_logo = str_replace(' ', '_', $proveedor->razon_social_p) . time() . $extension;
            $logo->move(public_path() . "/imgs/proveedores/", $nom_logo);
            // ASIGNAR LOGO
            $proveedor->logo_p = $nom_logo;
            $proveedor->fecha_reg_p = date('Y-m-d');
            $proveedor->user_id = Auth::user()->id;
            $proveedor->status = 1;
            $proveedor->save();


            $datos_original = HistorialAccion::getDetalleRegistro($proveedor, "proveedors");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' REGISTRO UN PYME',
                'datos_original' => $datos_original,
                'modulo' => 'PYMES',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            // registrar accion usuario
            AccionUser::registrarAccion("pymes", "crear");
            DB::commit();
            return redirect()->route('pymes.edit', $proveedor->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->bac()->with('error', 'error');
        }
    }

    public function edit(Proveedor $proveedor)
    {
        if (!Modulo::canMod("pymes", "editar")) {
            abort(401, "No tienes permiso para ver este modulo");
        }

        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('proveedores.edit', compact('empresa', 'proveedor'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($proveedor, "proveedors");
            $proveedor->update(array_map('mb_strtoupper', $request->except('logo_p')));
            if ($request->hasFile('logo_p')) {
                $logo_antiguo = $proveedor->logo_p;
                \File::delete(public_path() . "/imgs/proveedores/" . $logo_antiguo);
                //SUBIR LOGO
                $logo = $request->file('logo_p');
                $extension = "." . $logo->getClientOriginalExtension();
                $nom_logo = str_replace(' ', '_', $proveedor->razon_social_p) . time() . $extension;
                $logo->move(public_path() . "/imgs/proveedores/", $nom_logo);
                // ASIGNAR LOGO
                $proveedor->logo_p = $nom_logo;
                $proveedor->save();
            }

            $datos_nuevo = HistorialAccion::getDetalleRegistro($proveedor, "proveedors");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' MODIFICÓ UN PYME',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'PYMES',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
            // registrar accion usuario
            AccionUser::registrarAccion("pymes", "editar");
            DB::commit();
            return redirect()->route('pymes.edit', $proveedor->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'error');
        }
    }

    public function show(Proveedor $proveedor)
    {
    }

    public function destroy(Proveedor $proveedor)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($proveedor, "proveedors");
            $proveedor->status = 0;
            $proveedor->save();

            $datos_nuevo = HistorialAccion::getDetalleRegistro($proveedor, "proveedors");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' ELIMINÓ UN PYME',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'PYMES',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
            // registrar accion usuario
            AccionUser::registrarAccion("pymes", "eliminar");
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
}
