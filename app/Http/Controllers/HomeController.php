<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Empresa;
use App\Models\Producto;
use App\Models\User;
use App\Models\Proveedor;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empresa = Empresa::first();
        $datos = [];
        if (Auth::user()->tipo == 'ADMINISTRADOR') {
            $productos = Producto::where('status', '=', 1)->get();
            $usuarios = User::where('status', '=', 1)->get();
            $proveedores = Proveedor::where('status', '=', 1)->get();
            $datos = [
                'productos' => count($productos),
                'usuarios' => count($usuarios),
                'proveedores' => count($proveedores),
            ];
        }
        if (Auth::user()->tipo == 'ALMACENERO') {
            $productos = Producto::where('status', '=', 1)->get();
            $proveedores = Proveedor::where('status', '=', 1)->get();
            $datos = [
                'productos' => count($productos),
                'proveedores' => count($proveedores),
            ];
        }
        return view('home', compact('empresa', 'datos'));
    }
}
