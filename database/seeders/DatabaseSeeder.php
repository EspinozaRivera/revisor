<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //User::factory(50)->create();
        //Rol::factory(5)->create();

        $rol1 = new Rol();
        $rol1->nombre = 'administrador';
        $rol1->save();

        $rol2 = new Rol();
        $rol2->nombre = 'administradorEquipo';
        $rol2->save();

        $rol3 = new Rol();
        $rol3->nombre = 'administradorTorneo';
        $rol3->save();

        $rol4 = new Rol();
        $rol4->nombre = 'arbitro';
        $rol4->save();

        $rol5 = new Rol();
        $rol5->nombre = 'jugador';
        $rol5->save();

        $rol6 = new Rol();
        $rol6->nombre = 'fan';
        $rol6->save();
    }
}
