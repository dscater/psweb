<?php

namespace Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1
        Modulo::create([
            "titulo" => "Usuarios",
            "url" => "usuarios",
            "icon" => "people",
            "slug" => "usuarios.index",
        ]);

        // 2
        Modulo::create([
            "titulo" => "Pymes",
            "url" => "pymes",
            "icon" => "local_shipping",
            "slug" => "pymes.index",
        ]);

        // 3
        Modulo::create([
            "titulo" => "Productos",
            "url" => "productos",
            "icon" => "local_offer",
            "slug" => "productos.index",
        ]);

        // 4
        Modulo::create([
            "titulo" => "Tipos",
            "url" => "tipos",
            "icon" => "view_list",
            "slug" => "tipos.index",
        ]);

        // 5
        Modulo::create([
            "titulo" => "Marcas",
            "url" => "marcas",
            "icon" => "bookmark",
            "slug" => "marcas.index",
        ]);

        // 6
        Modulo::create([
            "titulo" => "Medidas",
            "url" => "medidas",
            "icon" => "list",
            "slug" => "medidas.index",
        ]);

        // 7
        Modulo::create([
            "titulo" => "Ingresos",
            "url" => "ingresos",
            "icon" => "local_shipping",
            "slug" => "ingresos.index",
        ]);
        // 8
        Modulo::create([
            "titulo" => "Salidas",
            "url" => "salidas",
            "icon" => "input",
            "slug" => "salidas.index",
        ]);

        // 9
        Modulo::create([
            "titulo" => "Tipos Ingresos/Salidas",
            "url" => "tipo_ingreso_salida",
            "icon" => "assignment_turned_in",
            "slug" => "tipo_ingreso_salida.index",
        ]);

        // 10
        Modulo::create([
            "titulo" => "Reportes",
            "url" => "reportes",
            "icon" => "assessment",
            "slug" => "reportes.index",
        ]);

        // 11
        Modulo::create([
            "titulo" => "Eventos de seguridad",
            "url" => "eventos_seguridads",
            "icon" => "view_list",
            "slug" => "eventos_seguridads.index",
        ]);

        // 12
        Modulo::create([
            "titulo" => "Usuarios y Roles",
            "url" => "usuarios_roles",
            "icon" => "view_list",
            "slug" => "usuarios_roles.index",
        ]);

        // 13
        Modulo::create([
            "titulo" => "Autenticación Segura",
            "url" => "autenticacion_seguras",
            "icon" => "view_list",
            "slug" => "autenticacion_seguras.index",
        ]);

        // 14
        Modulo::create([
            "titulo" => "Autorización Adecuada",
            "url" => "autenticacion_adecuadas",
            "icon" => "view_list",
            "slug" => "autenticacion_adecuadas.index",
        ]);

        // 15
        Modulo::create([
            "titulo" => "Prevención de ataques",
            "url" => "prevencion_ataques",
            "icon" => "view_list",
            "slug" => "prevencion_ataques.index",
        ]);

        // 16
        Modulo::create([
            "titulo" => "Auditoría y registros de eventos",
            "url" => "auditoria_eventos",
            "icon" => "view_list",
            "slug" => "auditoria_eventos.index",
        ]);

        // 17
        Modulo::create([
            "titulo" => "Alertas y notificaciones",
            "url" => "alertas_notificacions",
            "icon" => "view_list",
            "slug" => "alertas_notificacions.index",
        ]);

        // 18
        Modulo::create([
            "titulo" => "Respaldo y Recuperación",
            "url" => "respaldo_recuperacion",
            "icon" => "view_list",
            "slug" => "respaldo_recuperacion.index",
        ]);

        // 19
        Modulo::create([
            "titulo" => "Escaneo de vulnerabilidades",
            "url" => "escaneo_vulnerabilidads",
            "icon" => "view_list",
            "slug" => "escaneo_vulnerabilidads.index",
        ]);

        // 20
        Modulo::create([
            "titulo" => "Capacitación en Seguridad",
            "url" => "capacitacion_seguridads",
            "icon" => "view_list",
            "slug" => "capacitacion_seguridads.index",
        ]);
    }
}
