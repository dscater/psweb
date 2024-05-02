<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Models\Empresa;
use App\Http\Controllers\DatosUsuarioController;
use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\TiposIngresoSalidaController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $empresa = Empresa::first();
    return view('auth.login', compact('empresa'));
})->name("inicio_app");

Route::post("/login", [LoginController::class, 'login'])->name("login");
Route::post("/logout", [LoginController::class, 'logout'])->name("logout");


Route::middleware(['auth'])->group(function () {
    // HOME
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // USUARIOS
    Route::get('users', [DatosUsuarioController::class, 'index'])->name('users.index');

    Route::get('users/create', [DatosUsuarioController::class, 'create'])->name('users.create');

    Route::get('users/show/{datosUsuario}', [DatosUsuarioController::class, 'show'])->name('users.show');

    Route::get('users/edit/{datosUsuario}', [DatosUsuarioController::class, 'edit'])->name('users.edit');

    Route::post('users/store', [DatosUsuarioController::class, 'store'])->name('users.store');

    Route::put('users/update/{datosUsuario}', [DatosUsuarioController::class, 'update'])->name('users.update');

    Route::delete('users/destroy/{user}', [DatosUsuarioController::class, 'destroy'])->name('users.destroy');

    // Configuración de cuenta
    // contraseña
    Route::GET('users/configurar/cuenta/{user}', [DatosUsuarioController::class, 'config_cuenta'])->name('users.config');
    Route::PUT('users/configurar/cuenta/update/{user}', [DatosUsuarioController::class, 'cuenta_update'])->name('users.config_update');
    // foto de perfil
    Route::POST('users/configurar/cuenta/update/foto/{user}', [DatosUsuarioController::class, 'cuenta_update_foto'])->name('users.config_update_foto');

    // PROVEEDORES
    Route::get('proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');

    Route::get('proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');

    Route::get('proveedores/show/{proveedor}', [ProveedorController::class, 'show'])->name('proveedores.show');

    Route::get('proveedores/edit/{proveedor}', [ProveedorController::class, 'edit'])->name('proveedores.edit');

    Route::post('proveedores/store', [ProveedorController::class, 'store'])->name('proveedores.store');

    Route::put('proveedores/update/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');

    Route::delete('proveedores/destroy/{proveedor}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');

    // PRODUCTOS
    Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');

    Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create');

    Route::get('productos/show/{producto}', [ProductoController::class, 'show'])->name('productos.show');

    Route::get('productos/edit/{producto}', [ProductoController::class, 'edit'])->name('productos.edit');

    Route::post('productos/store', [ProductoController::class, 'store'])->name('productos.store');

    Route::put('productos/update/{producto}', [ProductoController::class, 'update'])->name('productos.update');

    Route::delete('productos/destroy/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    // TIPOS
    Route::get('tipos', [TipoController::class, 'index'])->name('tipos.index');

    Route::get('tipos/create', [TipoController::class, 'create'])->name('tipos.create');

    Route::get('tipos/show/{tipo}', [TipoController::class, 'show'])->name('tipos.show');

    Route::get('tipos/edit/{tipo}', [TipoController::class, 'edit'])->name('tipos.edit');

    Route::post('tipos/store', [TipoController::class, 'store'])->name('tipos.store');

    Route::put('tipos/update/{tipo}', [TipoController::class, 'update'])->name('tipos.update');

    Route::delete('tipos/destroy/{tipo}', [TipoController::class, 'destroy'])->name('tipos.destroy');

    // MARCAS
    Route::get('marcas', [MarcaController::class, 'index'])->name('marcas.index');

    Route::get('marcas/create', [MarcaController::class, 'create'])->name('marcas.create');

    Route::get('marcas/show/{marca}', [MarcaController::class, 'show'])->name('marcas.show');

    Route::get('marcas/edit/{marca}', [MarcaController::class, 'edit'])->name('marcas.edit');

    Route::post('marcas/store', [MarcaController::class, 'store'])->name('marcas.store');

    Route::put('marcas/update/{marca}', [MarcaController::class, 'update'])->name('marcas.update');

    Route::delete('marcas/destroy/{marca}', [MarcaController::class, 'destroy'])->name('marcas.destroy');

    // MEDIDAS
    Route::get('medidas', [MedidaController::class, 'index'])->name('medidas.index');

    Route::get('medidas/create', [MedidaController::class, 'create'])->name('medidas.create');

    Route::get('medidas/show/{medida}', [MedidaController::class, 'show'])->name('medidas.show');

    Route::get('medidas/edit/{medida}', [MedidaController::class, 'edit'])->name('medidas.edit');

    Route::post('medidas/store', [MedidaController::class, 'store'])->name('medidas.store');

    Route::put('medidas/update/{medida}', [MedidaController::class, 'update'])->name('medidas.update');

    Route::delete('medidas/destroy/{medida}', [MedidaController::class, 'destroy'])->name('medidas.destroy');

    // INGRESOS
    Route::get('productos/ingresos', [IngresoController::class, 'index'])->name('ingresos.index');

    Route::get('productos/ingresos/obtieneStock', [IngresoController::class, 'obtieneStock'])->name('ingresos.obtieneStock');

    Route::get('productos/ingresos/create', [IngresoController::class, 'create'])->name('ingresos.create');

    Route::get('productos/ingresos/show/{ingreso}', [IngresoController::class, 'show'])->name('ingresos.show');

    Route::get('productos/ingresos/edit/{ingreso}', [IngresoController::class, 'edit'])->name('ingresos.edit');

    Route::post('productos/ingresos/store', [IngresoController::class, 'store'])->name('ingresos.store');

    Route::put('productos/ingresos/update/{ingreso}', [IngresoController::class, 'update'])->name('ingresos.update');

    Route::delete('productos/ingresos/destroy/{ingreso}', [IngresoController::class, 'destroy'])->name('ingresos.destroy');

    // SALIDAS
    Route::get('productos/salidas', [SalidaController::class, 'index'])->name('salidas.index');

    Route::get('productos/salidas/obtieneStock', [SalidaController::class, 'obtieneStock'])->name('salidas.obtieneStock');

    Route::get('productos/salidas/create', [SalidaController::class, 'create'])->name('salidas.create');

    Route::get('productos/salidas/show/{salida}', [SalidaController::class, 'show'])->name('salidas.show');

    Route::get('productos/salidas/edit/{salida}', [SalidaController::class, 'edit'])->name('salidas.edit');

    Route::post('productos/salidas/store', [SalidaController::class, 'store'])->name('salidas.store');

    Route::put('productos/salidas/update/{salida}', [SalidaController::class, 'update'])->name('salidas.update');

    Route::delete('productos/salidas/destroy/{salida}', [SalidaController::class, 'destroy'])->name('salidas.destroy');

    // TIPOS DE INGRESOS/SALIDAS
    Route::get('productos/tipos_is', [TiposIngresoSalidaController::class, 'index'])->name('tipos_is.index');

    Route::get('productos/tipos_is/create', [TiposIngresoSalidaController::class, 'create'])->name('tipos_is.create');

    Route::get('productos/tipos_is/show/{tipo}', [TiposIngresoSalidaController::class, 'show'])->name('tipos_is.show');

    Route::get('productos/tipos_is/edit/{tipo}', [TiposIngresoSalidaController::class, 'edit'])->name('tipos_is.edit');

    Route::post('productos/tipos_is/store', [TiposIngresoSalidaController::class, 'store'])->name('tipos_is.store');

    Route::put('productos/tipos_is/update/{tipo}', [TiposIngresoSalidaController::class, 'update'])->name('tipos_is.update');

    Route::delete('productos/tipos_is/destroy/{tipo}', [TiposIngresoSalidaController::class, 'destroy'])->name('tipos_is.destroy');

    // DESCUENTOS
    Route::get('descuentos', [DescuentoController::class, 'index'])->name('descuentos.index');

    Route::get('descuentos/obtieneDescuento', [DescuentoController::class, 'obtieneDescuento'])->name('descuentos.obtieneDescuento');

    Route::get('descuentos/create', [DescuentoController::class, 'create'])->name('descuentos.create');

    Route::get('descuentos/show/{descuento}', [DescuentoController::class, 'show'])->name('descuentos.show');

    Route::get('descuentos/edit/{descuento}', [DescuentoController::class, 'edit'])->name('descuentos.edit');

    Route::post('descuentos/store', [DescuentoController::class, 'store'])->name('descuentos.store');

    Route::put('descuentos/update/{descuento}', [DescuentoController::class, 'update'])->name('descuentos.update');

    Route::delete('descuentos/destroy/{descuento}', [DescuentoController::class, 'destroy'])->name('descuentos.destroy');

    // VENTAS
    Route::get('productos/ventas', [VentaController::class, 'index'])->name('ventas.index');

    Route::get('productos/ventas/obtieneProducto', [VentaController::class, 'obtenerProducto'])->name('ventas.obtieneProducto');

    Route::get('productos/ventas/factura/{venta}', [VentaController::class, 'factura'])->name('ventas.factura');

    Route::get('productos/ventas/create', [VentaController::class, 'create'])->name('ventas.create');

    Route::get('productos/ventas/show/{venta}', [VentaController::class, 'show'])->name('ventas.show');

    Route::get('productos/ventas/edit/{venta}', [VentaController::class, 'edit'])->name('ventas.edit');

    Route::post('productos/ventas/store', [VentaController::class, 'store'])->name('ventas.store');

    Route::put('productos/ventas/update/{venta}', [VentaController::class, 'update'])->name('ventas.update');

    Route::delete('productos/ventas/destroy/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');

    // REPORTES
    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');

    Route::get('reportes/maestroProductos', [ReporteController::class, 'maestroProductos'])->name('reportes.maestroProductos');

    Route::get('reportes/ingresosProductos', [ReporteController::class, 'ingresosProductos'])->name('reportes.ingresosProductos');

    Route::get('reportes/salidasProductos', [ReporteController::class, 'salidasProductos'])->name('reportes.salidasProductos');

    Route::get('reportes/kardexInventario', [ReporteController::class, 'kardexInventario'])->name('reportes.kardexInventario');

    Route::get('reportes/movimientoProductos', [ReporteController::class, 'movimientoProductos'])->name('reportes.movimientoProductos');

    Route::get('reportes/libroCompras', [ReporteController::class, 'libroCompras'])->name('reportes.libroCompras');

    Route::get('reportes/libroVentas', [ReporteController::class, 'libroVentas'])->name('reportes.libroVentas');
});
