<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Revision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('nombreDoc');
            $table->longText('documento');
            $table->string('revisor1');
            $table->boolean('r1')->nullable();
            $table->string('revisor2');
            $table->boolean('r2')->nullable();
            $table->string('revisor3');
            $table->boolean('r3')->nullable();
            $table->boolean('estatus');
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
        Schema::dropIfExists('revision');
    }
}
