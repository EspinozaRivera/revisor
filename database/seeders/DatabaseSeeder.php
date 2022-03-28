<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rol;
use App\Models\RolPorUsuario;
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

        $user =  new User();
        $user->curp = 'EIRJ980922MSLSVV02';
        $user->nombre = 'nombre';
        $user->apellido1 = 'ap1';
        $user->apellido2 = 'ap2';
        $user->email = 'jotasbb@gmail.com';
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->status = 1;
        $user->save();

        $rolPorUsuario = new RolPorUsuario();
        $rolPorUsuario->idUsuario = 1;
        $rolPorUsuario->idRol = 1;
        $rolPorUsuario->save();

        $rolPorUsuario1 = new RolPorUsuario();
        $rolPorUsuario1->idUsuario = 1;
        $rolPorUsuario1->idRol = 2;
        $rolPorUsuario1->save();
    }
}
