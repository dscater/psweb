<?php

use App\Http\Controllers\AlertaNotificacionController;
use App\Http\Controllers\AuditoriaEventoController;
use App\Http\Controllers\AutenticacionAdecuadaController;
use App\Http\Controllers\AutenticacionSeguraController;
use App\Http\Controllers\CapacitacionSeguridadController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Models\Empresa;
use App\Http\Controllers\DatosUsuarioController;
use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\EscaneoVunerabilidadController;
use App\Http\Controllers\EventoSeguridadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\PrevencionAtaqueController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RespaldoRecuperacionController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\TiposIngresoSalidaController;
use App\Http\Controllers\UserModuloController;
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

Route::get('/login', function () {
    $empresa = Empresa::first();
    return view('auth.login', compact('empresa'));
})->name("login.view");

Route::middleware(['security.login', 'throttle.login'])->group(function () {
    Route::post("/login", [LoginController::class, 'login'])->name("login");
});
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
    Route::get('pymes', [ProveedorController::class, 'index'])->name('pymes.index');

    Route::get('pymes/create', [ProveedorController::class, 'create'])->name('pymes.create');

    Route::get('pymes/show/{proveedor}', [ProveedorController::class, 'show'])->name('pymes.show');

    Route::get('pymes/edit/{proveedor}', [ProveedorController::class, 'edit'])->name('pymes.edit');

    Route::post('pymes/store', [ProveedorController::class, 'store'])->name('pymes.store');

    Route::put('pymes/update/{proveedor}', [ProveedorController::class, 'update'])->name('pymes.update');

    Route::delete('pymes/destroy/{proveedor}', [ProveedorController::class, 'destroy'])->name('pymes.destroy');

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
    Route::get('productos/tipo_ingreso_salida', [TiposIngresoSalidaController::class, 'index'])->name('tipo_ingreso_salida.index');

    Route::get('productos/tipo_ingreso_salida/create', [TiposIngresoSalidaController::class, 'create'])->name('tipo_ingreso_salida.create');

    Route::get('productos/tipo_ingreso_salida/show/{tipo}', [TiposIngresoSalidaController::class, 'show'])->name('tipo_ingreso_salida.show');

    Route::get('productos/tipo_ingreso_salida/edit/{tipo}', [TiposIngresoSalidaController::class, 'edit'])->name('tipo_ingreso_salida.edit');

    Route::post('productos/tipo_ingreso_salida/store', [TiposIngresoSalidaController::class, 'store'])->name('tipo_ingreso_salida.store');

    Route::put('productos/tipo_ingreso_salida/update/{tipo}', [TiposIngresoSalidaController::class, 'update'])->name('tipo_ingreso_salida.update');

    Route::delete('productos/tipo_ingreso_salida/destroy/{tipo}', [TiposIngresoSalidaController::class, 'destroy'])->name('tipo_ingreso_salida.destroy');

    // USUARIOS ROLES
    Route::get('usuarios_roles', [UserModuloController::class, 'index'])->name('usuarios_roles.index');

    Route::get('usuarios_roles/create', [UserModuloController::class, 'create'])->name('usuarios_roles.create');

    Route::get('usuarios_roles/show/{tipo}', [UserModuloController::class, 'show'])->name('usuarios_roles.show');

    Route::get('usuarios_roles/edit/{tipo}', [UserModuloController::class, 'edit'])->name('usuarios_roles.edit');

    Route::post('usuarios_roles/store', [UserModuloController::class, 'store'])->name('usuarios_roles.store');

    Route::put('usuarios_roles/update', [UserModuloController::class, 'update'])->name('usuarios_roles.update');

    Route::delete('usuarios_roles/destroy/{tipo}', [UserModuloController::class, 'destroy'])->name('usuarios_roles.destroy');

    // AUTENTICACION SEGURA
    Route::get('autenticacion_seguras', [AutenticacionSeguraController::class, 'index'])->name('autenticacion_seguras.index');

    Route::get('autenticacion_seguras/create', [AutenticacionSeguraController::class, 'create'])->name('autenticacion_seguras.create');

    Route::get('autenticacion_seguras/show/{tipo}', [AutenticacionSeguraController::class, 'show'])->name('autenticacion_seguras.show');

    Route::get('autenticacion_seguras/edit/{tipo}', [AutenticacionSeguraController::class, 'edit'])->name('autenticacion_seguras.edit');

    Route::post('autenticacion_seguras/store', [AutenticacionSeguraController::class, 'store'])->name('autenticacion_seguras.store');

    Route::put('autenticacion_seguras/update/{tipo}', [AutenticacionSeguraController::class, 'update'])->name('autenticacion_seguras.update');

    Route::delete('autenticacion_seguras/destroy/{tipo}', [AutenticacionSeguraController::class, 'destroy'])->name('autenticacion_seguras.destroy');

    // AUTENTICACION ADECUADA
    Route::get('autenticacion_adecuadas', [AutenticacionAdecuadaController::class, 'index'])->name('autenticacion_adecuadas.index');

    Route::get('autenticacion_adecuadas/create', [AutenticacionAdecuadaController::class, 'create'])->name('autenticacion_adecuadas.create');

    Route::get('autenticacion_adecuadas/show/{tipo}', [AutenticacionAdecuadaController::class, 'show'])->name('autenticacion_adecuadas.show');

    Route::get('autenticacion_adecuadas/edit/{tipo}', [AutenticacionAdecuadaController::class, 'edit'])->name('autenticacion_adecuadas.edit');

    Route::post('autenticacion_adecuadas/store', [AutenticacionAdecuadaController::class, 'store'])->name('autenticacion_adecuadas.store');

    Route::put('autenticacion_adecuadas/update/{tipo}', [AutenticacionAdecuadaController::class, 'update'])->name('autenticacion_adecuadas.update');

    Route::delete('autenticacion_adecuadas/destroy/{tipo}', [AutenticacionAdecuadaController::class, 'destroy'])->name('autenticacion_adecuadas.destroy');

    // PREVENCION ATAQUES
    Route::get('prevencion_ataques', [PrevencionAtaqueController::class, 'index'])->name('prevencion_ataques.index');

    Route::get('prevencion_ataques/create', [PrevencionAtaqueController::class, 'create'])->name('prevencion_ataques.create');

    Route::get('prevencion_ataques/show/{tipo}', [PrevencionAtaqueController::class, 'show'])->name('prevencion_ataques.show');

    Route::get('prevencion_ataques/edit/{tipo}', [PrevencionAtaqueController::class, 'edit'])->name('prevencion_ataques.edit');

    Route::post('prevencion_ataques/store', [PrevencionAtaqueController::class, 'store'])->name('prevencion_ataques.store');

    Route::put('prevencion_ataques/update/{tipo}', [PrevencionAtaqueController::class, 'update'])->name('prevencion_ataques.update');

    Route::delete('prevencion_ataques/destroy/{tipo}', [PrevencionAtaqueController::class, 'destroy'])->name('prevencion_ataques.destroy');

    // PREVENCION ATAQUES
    Route::get('auditoria_eventos', [AuditoriaEventoController::class, 'index'])->name('auditoria_eventos.index');

    Route::get('auditoria_eventos/create', [AuditoriaEventoController::class, 'create'])->name('auditoria_eventos.create');

    Route::get('auditoria_eventos/show/{tipo}', [AuditoriaEventoController::class, 'show'])->name('auditoria_eventos.show');

    Route::get('auditoria_eventos/edit/{tipo}', [AuditoriaEventoController::class, 'edit'])->name('auditoria_eventos.edit');

    Route::post('auditoria_eventos/store', [AuditoriaEventoController::class, 'store'])->name('auditoria_eventos.store');

    Route::put('auditoria_eventos/update/{tipo}', [AuditoriaEventoController::class, 'update'])->name('auditoria_eventos.update');

    Route::delete('auditoria_eventos/destroy/{tipo}', [AuditoriaEventoController::class, 'destroy'])->name('auditoria_eventos.destroy');

    // PREVENCION ATAQUES
    Route::get('alertas_notificacions', [AlertaNotificacionController::class, 'index'])->name('alertas_notificacions.index');

    Route::get('alertas_notificacions/create', [AlertaNotificacionController::class, 'create'])->name('alertas_notificacions.create');

    Route::get('alertas_notificacions/show/{tipo}', [AlertaNotificacionController::class, 'show'])->name('alertas_notificacions.show');

    Route::get('alertas_notificacions/edit/{tipo}', [AlertaNotificacionController::class, 'edit'])->name('alertas_notificacions.edit');

    Route::post('alertas_notificacions/store', [AlertaNotificacionController::class, 'store'])->name('alertas_notificacions.store');

    Route::put('alertas_notificacions/update/{tipo}', [AlertaNotificacionController::class, 'update'])->name('alertas_notificacions.update');

    Route::delete('alertas_notificacions/destroy/{tipo}', [AlertaNotificacionController::class, 'destroy'])->name('alertas_notificacions.destroy');

    // RESPALDO RECUPERACION
    Route::get('respaldo_recuperacion', [RespaldoRecuperacionController::class, 'index'])->name('respaldo_recuperacion.index');

    Route::get('respaldo_recuperacion/create', [RespaldoRecuperacionController::class, 'create'])->name('respaldo_recuperacion.create');

    Route::get('respaldo_recuperacion/show/{tipo}', [RespaldoRecuperacionController::class, 'show'])->name('respaldo_recuperacion.show');

    Route::get('respaldo_recuperacion/edit/{tipo}', [RespaldoRecuperacionController::class, 'edit'])->name('respaldo_recuperacion.edit');

    Route::post('respaldo_recuperacion/store', [RespaldoRecuperacionController::class, 'store'])->name('respaldo_recuperacion.store');

    Route::post('respaldo_recuperacion/cargaRecuperacion/{respaldoDb}', [RespaldoRecuperacionController::class, 'cargaRecuperacion'])->name('respaldo_recuperacion.cargaRecuperacion');

    Route::put('respaldo_recuperacion/update/{tipo}', [RespaldoRecuperacionController::class, 'update'])->name('respaldo_recuperacion.update');

    Route::delete('respaldo_recuperacion/destroy/{tipo}', [RespaldoRecuperacionController::class, 'destroy'])->name('respaldo_recuperacion.destroy');

    // RESPALDO RECUPERACION
    Route::get('escaneo_vulnerabilidads', [EscaneoVunerabilidadController::class, 'index'])->name('escaneo_vulnerabilidads.index');

    Route::get('escaneo_vulnerabilidads/create', [EscaneoVunerabilidadController::class, 'create'])->name('escaneo_vulnerabilidads.create');

    Route::get('escaneo_vulnerabilidads/show/{tipo}', [EscaneoVunerabilidadController::class, 'show'])->name('escaneo_vulnerabilidads.show');

    Route::get('escaneo_vulnerabilidads/edit/{tipo}', [EscaneoVunerabilidadController::class, 'edit'])->name('escaneo_vulnerabilidads.edit');

    Route::post('escaneo_vulnerabilidads/store', [EscaneoVunerabilidadController::class, 'store'])->name('escaneo_vulnerabilidads.store');

    Route::put('escaneo_vulnerabilidads/update/{tipo}', [EscaneoVunerabilidadController::class, 'update'])->name('escaneo_vulnerabilidads.update');

    Route::delete('escaneo_vulnerabilidads/destroy/{tipo}', [EscaneoVunerabilidadController::class, 'destroy'])->name('escaneo_vulnerabilidads.destroy');

    // CAPACITACION SEGURIDAD
    Route::get('capacitacion_seguridads', [CapacitacionSeguridadController::class, 'index'])->name('capacitacion_seguridads.index');

    Route::get('capacitacion_seguridads/create', [CapacitacionSeguridadController::class, 'create'])->name('capacitacion_seguridads.create');

    Route::get('capacitacion_seguridads/show/{tipo}', [CapacitacionSeguridadController::class, 'show'])->name('capacitacion_seguridads.show');

    Route::get('capacitacion_seguridads/edit/{tipo}', [CapacitacionSeguridadController::class, 'edit'])->name('capacitacion_seguridads.edit');

    Route::post('capacitacion_seguridads/store', [CapacitacionSeguridadController::class, 'store'])->name('capacitacion_seguridads.store');

    Route::put('capacitacion_seguridads/update/{tipo}', [CapacitacionSeguridadController::class, 'update'])->name('capacitacion_seguridads.update');

    Route::delete('capacitacion_seguridads/destroy/{tipo}', [CapacitacionSeguridadController::class, 'destroy'])->name('capacitacion_seguridads.destroy');

    // CAPACITACION SEGURIDAD
    Route::get('eventos_seguridads', [EventoSeguridadController::class, 'index'])->name('eventos_seguridads.index');
    Route::get('eventos_seguridads/byUser', [EventoSeguridadController::class, 'byUser'])->name('eventos_seguridads.byUser');
    Route::get('eventos_seguridads/show/{notificacion_user}', [EventoSeguridadController::class, 'show'])->name('eventos_seguridads.show');

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
