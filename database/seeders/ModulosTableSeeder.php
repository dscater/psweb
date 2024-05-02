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
        Modulo::create([
            "titulo" => "Usuarios",
            "url" => "users",
            "icon" => "people",
            "slug" => "users.index",
        ]);

        Modulo::create([
            "titulo" => "Pynes",
            "url" => "proveedores",
            "icon" => "local_shipping",
            "slug" => "proveedores.index",
        ]);

        Modulo::create([
            "titulo" => "Productos",
            "url" => "productos",
            "icon" => "local_offer",
            "slug" => "productos.index",
        ]);

        Modulo::create([
            "titulo" => "Tipos",
            "url" => "tipos",
            "icon" => "view_list",
            "slug" => "tipos.index",
        ]);

        Modulo::create([
            "titulo" => "Marcas",
            "url" => "marcas",
            "icon" => "bookmark",
            "slug" => "marcas.index",
        ]);

        Modulo::create([
            "titulo" => "Medidas",
            "url" => "medidas",
            "icon" => "list",
            "slug" => "medidas.index",
        ]);

        Modulo::create([
            "titulo" => "Reportes",
            "url" => "reportes",
            "icon" => "assessment",
            "slug" => "reportes.index",
        ]);

        Modulo::create([
            "titulo" => "Usuarios y Roles",
            "url" => "usuarios_roles",
            "icon" => "view_list",
            "slug" => "usuarios_roles.index",
        ]);

        Modulo::create([
            "titulo" => "Autentiación Segura",
            "url" => "autenticacion_seguras",
            "icon" => "view_list",
            "slug" => "autenticacion_seguras.index",
        ]);

        Modulo::create([
            "titulo" => "Autorización Adecuada",
            "url" => "autenticacion_adecuadas",
            "icon" => "view_list",
            "slug" => "autenticacion_adecuadas.index",
        ]);

        Modulo::create([
            "titulo" => "Prevención de ataques",
            "url" => "prevencion_ataques",
            "icon" => "view_list",
            "slug" => "prevencion_ataques.index",
        ]);

        Modulo::create([
            "titulo" => "Auditoría y registros de eventos",
            "url" => "auditoria_eventos",
            "icon" => "view_list",
            "slug" => "auditoria_eventos.index",
        ]);

        Modulo::create([
            "titulo" => "Alertas y Notificaciones",
            "url" => "alertas_notificacions",
            "icon" => "view_list",
            "slug" => "alertas_notificacions.index",
        ]);

        Modulo::create([
            "titulo" => "Respaldo y Recuperación",
            "url" => "respaldo_recuperacion",
            "icon" => "view_list",
            "slug" => "respaldo_recuperacion.index",
        ]);

        Modulo::create([
            "titulo" => "Escaneo de vulnerabilidades",
            "url" => "escaneo_vulnerabilidads",
            "icon" => "view_list",
            "slug" => "escaneo_vulnerabilidads.index",
        ]);

        Modulo::create([
            "titulo" => "Capacitación en Seguridad",
            "url" => "capacitacion_seguridads",
            "icon" => "view_list",
            "slug" => "capacitacion_seguridads.index",
        ]);
    }
}
