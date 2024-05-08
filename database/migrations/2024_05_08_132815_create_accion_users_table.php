<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accion_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("modulo_id");
            $table->unsignedBigInteger("user_id");
            $table->integer("crear")->default(0);
            $table->integer("editar")->default(0);
            $table->integer("eliminar")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accion_users');
    }
};
