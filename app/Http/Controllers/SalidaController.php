<?php

namespace App\Http\Controllers;

use App\Models\AccionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Salida;
use App\Models\Producto;
use App\Models\TiposIngresoSalida;
use App\Models\ProductoRfid;
use App\Models\Empresa;
use App\Models\HistorialAccion;
use App\Models\Modulo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalidaController extends Controller
{
    public function index(Request $request)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            $salidas = Salida::all();
            if ($request->ajax()) {
                return response()->JSON(view('salidas.parcial.lista', compact('salidas'))->render());
            }
            return view('salidas.index', compact('empresa', 'salidas'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function obtieneStock(Request $request)
    {
        // $comprueba = ProductoRfid::where('rfid', '=', $request->rfid)->get();
        $producto = Producto::where('cod_unico', '=', $request->rfid)->get()->first();
        if ($producto) {
            $stock = $producto->stock->cant_actual;
            $producto = $producto;

            $id = $producto->id;
            $nombre = $producto->nom;
            $imagen = $producto->imagen;
            $precio = number_format($producto->precio, 2, '.', ',');
        } else {
            $nombre = "GRUPO";
            $imagen = "producto_default.png";
            $stock = 0;
            $id = 0;
            $precio = "0.00";
        }
        return response()->JSON([
            'stock' => $stock,
            'nombre' => $nombre,
            'imagen' => $imagen,
            'precio' => $precio,
            'id' => $id,
        ]);
    }

    public function create()
    {
        if (!Modulo::canMod("salidas", "crear")) {
            abort(401, "No tienes permiso para ver este modulo");
        }

        $empresa = Empresa::first();

        $productos = Producto::where('status', '=', 1)->get();
        $tipos_is = TiposIngresoSalida::orderBy('nom', 'DESC')->get();
        $array_productos[''] = '';
        foreach ($productos as $producto) {
            $array_productos[$producto->id] = $producto->nom;
        }
        $array_tipos[''] = '';
        foreach ($tipos_is as $value) {
            $array_tipos[$value->nom] = $value->nom;
        }
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('salidas.create', compact('empresa', 'array_productos', 'array_tipos'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $producto = Producto::find($request->id);
            if ($producto) {
                // REGISTRAR LA SALIDA
                $salida = new Salida();
                $salida->tipo_nom = $request->tipo;
                $salida->producto_id = $producto->id;
                $salida->user_id = Auth::user()->id;
                $salida->precio_uni = $request->precio_uni;
                $salida->cantidad = $request->cantidad;
                $salida->descripcion = mb_strtoupper($request->descripcion);
                $salida->fecha_salida = date('Y-m-d');
                if ($salida->save()) {
                    // ACTUALIZAR STOCK
                    $cant_actual = $producto->stock->cant_actual;
                    $cant_salidas = $producto->stock->cant_salidas;
                    $producto->stock->cant_actual = $cant_actual - (float)$request->cantidad;
                    $producto->stock->cant_salidas = $cant_salidas + (float)$request->cantidad;
                    $producto->stock->save();

                    $datos_original = HistorialAccion::getDetalleRegistro($salida, "salidas");
                    HistorialAccion::create([
                        'user_id' => Auth::user()->id,
                        'accion' => 'CREACIÓN',
                        'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' REGISTRO UNA SALIDA',
                        'datos_original' => $datos_original,
                        'modulo' => 'SALIDAS',
                        'fecha' => date('Y-m-d'),
                        'hora' => date('H:i:s')
                    ]);

                    // registrar accion usuario
                    AccionUser::registrarAccion("salidas", "crear");

                    DB::commit();
                    return response()->JSON([
                        'msg' => "BIEN"
                    ]);
                } else {
                    return response()->JSON([
                        'msg' => "MAL"
                    ]);
                }
            } else {
                return response()->JSON([
                    'msg' => "NO EXISTE"
                ]);
            }
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            DB::rollBack();
            return response()->JSON([
                'msg' => "MAL"
            ]);
        }
    }

    public function edit(Salida $ingreso)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('salidas.edit', compact('empresa', 'ingreso'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function update(Request $request, Salida $ingreso)
    {
        $ingreso->update(array_map('mb_strtoupper', $request->except('logo_p')));
        return redirect()->route('salidas.edit', $ingreso->id)->with('success', 'success');
    }

    public function show(Ingreso $ingreso)
    {
    }

    public function destroy(Salida $ingreso)
    {
        $existe_uso = Producto::where('ingreso', '=', $ingreso->nom)->get();
        if (count($existe_uso) == 0) {
            $ingreso->delete();
            return response()->JSON([
                'msg' => 'cambiar status',
            ]);
        } else {
            return response()->JSON([
                'msg' => 'NO',
            ]);
        }
    }
}
