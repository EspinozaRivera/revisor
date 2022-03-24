<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //aqui no hay status, se borra directamente el premiso a la bencha
        Schema::create('rolesPorUsuario', function (Blueprint $table) {
            $table->id('idRolesPorUsuario');
            $table->integer('idUsuarios');
            $table->integer('idRol');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rolesPorUsuario');
    }
};
