<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductoUpdateRequest;
use App\Http\Requests\ProductoStoreRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Producto;
use App\Models\Empresa;
use App\Models\Tipo;
use App\Models\Marca;
use App\Models\Medida;
use App\Models\Proveedor;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'CAJA' || Auth::user()->tipo == 'ALMACENERO') {
            $productos = Producto::lista();
            if ($request->ajax()) {
                return response()->JSON(view('productos.parcial.lista', compact('productos'))->render());
            }
            return view('productos.index', compact('empresa', 'productos'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function create()
    {
        $empresa = Empresa::first();

        $tipos = Tipo::all();
        $marcas = Marca::all();
        $medidas = Medida::all();
        $proveedores = Proveedor::where('status', 1)->get();

        $array_tipos[''] = '';
        $array_marcas[''] = '';
        $array_medidas[''] = '';
        $array_proveedores[''] = '';
        foreach ($tipos  as $tipo) {
            $array_tipos[$tipo->id] = $tipo->nom;
        }
        foreach ($marcas  as $marca) {
            $array_marcas[$marca->id] = $marca->nom;
        }
        foreach ($medidas  as $medida) {
            $array_medidas[$medida->id] = $medida->nom;
        }
        foreach ($proveedores  as $proveedor) {
            $array_proveedores[$proveedor->id] = $proveedor->razon_social_p;
        }

        $codigo = "";
        $ultimo_producto = Producto::get()->last();
        if ($ultimo_producto) {
            $codigo = (int)(substr($ultimo_producto->cod, 1, strlen($ultimo_producto->cod)));
            $codigo++;
            if ($codigo < 10) {
                $codigo = "P000" . $codigo;
            } elseif ($codigo < 100) {
                $codigo = "P00" . $codigo;
            } elseif ($codigo < 1000) {
                $codigo = "P0" . $codigo;
            } else {
                $codigo = "P" . $codigo;
            }
            // return $ultimo_producto;
        } else {
            $codigo = "P0001";
            // return $codigo;
        }

        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('productos.create', compact(
                'empresa',
                'array_tipos',
                'array_marcas',
                'array_medidas',
                'array_proveedores',
                'codigo'
            ));
        }

        return view('errors.sin_permiso', compact('empresa'));
    }

    public function store(ProductoStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $producto = new Producto(array_map('mb_strtoupper', $request->except('imagen')));
            //SUBIR IMAGEN
            $imagen = $request->file('imagen');
            $extension = "." . $imagen->getClientOriginalExtension();
            $nom_imagen = str_replace(' ', '_', $producto->cod) . str_replace(' ', '_', $producto->nom) . time() . $extension;
            $imagen->move(public_path() . "/imgs/productos/", $nom_imagen);
            // ASIGNAR imagen
            $producto->imagen = $nom_imagen;
            $producto->fecha_reg = date('Y-m-d');
            $producto->user_id = Auth::user()->id;
            $producto->status = 1;
            $producto->save();

            //INICIALIZANDO STOCK
            $stock = new Stock();
            $stock->cant_ingresos = 0;
            $stock->cant_actual = 0;
            $stock->cant_salidas = 0;
            $stock->cant_min = $request->cant_min;
            $stock->fecha_movimiento = date('Y-m-d');
            $stock->fecha_reg = date('Y-m-d');
            $stock->producto_id = $producto->id;
            $stock->save();

            $datos_original = HistorialAccion::getDetalleRegistro($producto, "productos");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' REGISTRO UN PRODUCTO',
                'datos_original' => $datos_original,
                'modulo' => 'PRODUCTOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return redirect()->route('productos.edit', $producto->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'error');
        }
    }

    public function edit(Producto $producto)
    {
        $empresa = Empresa::first();

        $tipos = Tipo::all();
        $marcas = Marca::all();
        $medidas = Medida::all();
        $proveedores = Proveedor::where('status', 1)->get();

        $array_tipos[''] = '';
        $array_marcas[''] = '';
        $array_medidas[''] = '';
        $array_proveedores[''] = '';
        foreach ($tipos  as $tipo) {
            $array_tipos[$tipo->id] = $tipo->nom;
        }
        foreach ($marcas  as $marca) {
            $array_marcas[$marca->id] = $marca->nom;
        }
        foreach ($medidas  as $medida) {
            $array_medidas[$medida->id] = $medida->nom;
        }
        foreach ($proveedores  as $proveedor) {
            $array_proveedores[$proveedor->id] = $proveedor->razon_social_p;
        }
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO') {
            return view('productos.edit', compact('empresa', 'producto', 'array_tipos', 'array_marcas', 'array_medidas', 'array_proveedores'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function update(ProductoUpdateRequest $request, Producto $producto)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($producto, "productos");
            $producto->update(array_map('mb_strtoupper', $request->except('imagen')));
            if ($request->hasFile('imagen')) {
                $imagen_antigua = $producto->imagen;
                \File::delete(public_path() . "/imgs/productos/" . $imagen_antigua);
                //SUBIR IMAGEN
                $imagen = $request->file('imagen');
                $extension = "." . $imagen->getClientOriginalExtension();
                $nom_imagen = str_replace(' ', '_', $producto->cod) . str_replace(' ', '_', $producto->nom) . time() . $extension;
                $imagen->move(public_path() . "/imgs/productos/", $nom_imagen);
                // ASIGNAR LOGO
                $producto->imagen = $nom_imagen;
                $producto->save();
            }
            $producto->stock->cant_min = $request->cant_min;
            $producto->stock->save();

            $datos_nuevo = HistorialAccion::getDetalleRegistro($producto, "productos");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' MODIFICÓ UN PRODUCTO',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'PRODUCTOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return redirect()->route('productos.edit', $producto->id)->with('success', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'error');
        }
    }

    public function show(Producto $producto)
    {
        $empresa = Empresa::first();
        if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'ALMACENERO' || Auth::user()->tipo == 'CAJA') {
            return view('productos.show', compact('empresa', 'producto'));
        }
        return view('errors.sin_permiso', compact('empresa'));
    }

    public function destroy(Producto $producto)
    {
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($producto, "productos");
            $producto->status = 0;
            $producto->save();

            $datos_nuevo = HistorialAccion::getDetalleRegistro($producto, "productos");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->name . ' ELIMINÓ UN PRODUCTO',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'PRODUCTOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
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
